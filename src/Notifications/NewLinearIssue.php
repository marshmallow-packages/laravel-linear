<?php

namespace LaravelLinear\Notifications;

use App\Notifications\Messages\VoiceMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use LaravelLinear\Notifications\Messages\LinearIssue;

class NewLinearIssue extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        protected LinearIssue $issue
    ) {
    }

    /**
     * Get the notification channels.
     *
     * @param  mixed  $notifiable
     * @return array|string
     */
    public function via($notifiable)
    {
        return [LinearChannel::class];
    }

    /**
     * Get the voice representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return VoiceMessage
     */
    public function toLinear($notifiable): LinearIssue
    {
        return $this->issue;
    }
}
