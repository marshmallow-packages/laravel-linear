<?php

namespace LaravelLinear\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use LaravelLinear\Models\LinearToken;
use LaravelLinear\Notifications\Messages\LinearIssue;

class LinearChannel
{
    /**
     * Send the given notification.
     *
     * @param  mixed  $notifiable
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return void
     */
    public function send($notifiable, Notification $notification)
    {
        $this->createIssue(
            $notification->toLinear($notifiable)
        );
    }

    protected function createIssue(LinearIssue $issue)
    {
        $client = config('linear.service.client_id');
        $token = LinearToken::first();

        $url = 'https://api.linear.app/graphql';
        $headers = [
            'headers' => ['Content-Type' => 'application/json'],
        ];

        $client = Http::withToken($token->access_token)->withHeaders($headers);

        $query = '
        mutation IssueCreate {
            issueCreate(input: {
                teamId: "'.$token->team_id.'"
                projectId: "'.$token->project_id.'"
                title: "'.$issue->getTitle().'"
                description: "'.$issue->getMessage().'"
                createAsUser: "'.$issue->getSubmitter().'"
            }) {
                    success
                    issue {
                        id
                        title
                    }
                }
            }';

        $response = $client->post($url, ['query' => $query]);
        $issue_id = Arr::get($response->json(), 'data.issueCreate.issue.id');

        $issue->getAttachments()->each(function ($path) use ($issue_id, $url, $query, $client) {
            $query = '
            mutation{
            attachmentCreate(input:{
                issueId: "'.$issue_id.'"
                title: "Issue Attachment"
                url: "'.$path.'"
            }){
                success
                attachment {
                    id
                }
            }
            }';

            $client->post($url, ['query' => $query]);
        });
    }
}
