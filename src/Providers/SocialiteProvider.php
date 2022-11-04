<?php

namespace LaravelLinear\Providers;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Laravel\Socialite\Two\AbstractProvider;
use Laravel\Socialite\Two\InvalidStateException;
use Laravel\Socialite\Two\ProviderInterface;
use Laravel\Socialite\Two\User;
use LaravelLinear\Models\LinearToken;

class SocialiteProvider extends AbstractProvider implements ProviderInterface
{
    protected $scopeSeparator = ',';

    protected $scopes = ['read', 'write'];

    protected $stateless = true;

    protected $parameters = ['actor' => 'application'];

    protected function getAuthUrl($state)
    {
        return $this->buildAuthUrlFromBase('https://linear.app/oauth/authorize', $state);
    }

    protected function getBaseUrl()
    {
        return 'https://api.linear.app/graphql';
    }

    protected function getTokenUrl()
    {
        return 'https://api.linear.app/oauth/token';
    }

    public function revokeAccessToken($token): bool
    {
        $headers = [
            'headers' => ['Content-Type' => 'application/x-www-form-urlencoded'],
        ];

        $response = Http::withHeaders($headers)->asForm()->post('https://api.linear.app/oauth/revoke', ['access_token' => $token]);

        if ($response->successful()) {
            LinearToken::where('access_token', $token)->delete();

            return true;
        }

        return false;
    }

    public function getAccessTokenResponse($code)
    {
        $headers = [
            'headers' => ['Content-Type' => 'application/x-www-form-urlencoded'],
        ];

        $response = Http::withHeaders($headers)->asForm()->post($this->getTokenUrl(), $this->getTokenFields($code));

        $data = $response->json();

        if ($response->failed()) {
            throw (new \Exception($data['error_description']));
        }

        return $data;
    }

    /**
     * {@inheritdoc}
     */
    public function user()
    {
        if ($this->user) {
            return $this->user;
        }

        if ($this->hasInvalidState()) {
            throw new InvalidStateException;
        }

        $response = $this->getAccessTokenResponse($this->getCode());

        $this->user = $this->mapUserToObject($this->getUserByToken(
            $token = Arr::get($response, 'access_token')
        ));

        $scope = Arr::get($response, 'scope', '');
        $expires_in = Arr::get($response, 'expires_in');

        return $this->user->setToken($token)
            ->setExpiresIn($expires_in)
            ->setApprovedScopes($scope);
    }

    protected function mapUserToObject(array $user)
    {
        return (new User)->setRaw($user);
    }

    protected function getUserByToken($token)
    {
        $user = Auth::user();

        $old_linear_token = LinearToken::where([
            'user_id' => $user->id,
        ])->whereNot('access_token', $token)->latest()->first();

        if ($old_linear_token) {
            $this->revokeAccessToken($old_linear_token->access_token);
        }

        $linear_token = LinearToken::where('access_token', $token)->latest()->first();

        if ($linear_token) {
            $user = $linear_token->user;
        }

        return $user->toArray();
    }

    public function getOrganizationData($token)
    {
        $query = 'query Organization {
            organization {
                id
                name
                teams {
                    nodes {
                        id
                        name
                        projects(first: 75) {
                            nodes {
                                id
                                name
                            }
                        }
                    }
                }
            }
        }';

        $response = Http::withToken($token)->post($this->getBaseUrl(), ['query' => $query]);
        $data = $response->json();

        if ($response->failed()) {
            throw (new \Exception(Arr::get($data, 'errors.0.message')));
        }

        return $data['data'];
    }

    public function getOrganizationIssueLabels($token)
    {
        $query = '
            query IssueLabels {
                issueLabels {
                    nodes {
                    id
                    name
                    description
                    }
                }
            }';

        $response = Http::withToken($token)->post($this->getBaseUrl(), ['query' => $query]);
        $data = $response->json();

        $labels = collect();
        foreach (Arr::get($data, 'data.issueLabels.nodes') as $label) {
            $labels->push($label);
        }
        return $labels;
    }
}
