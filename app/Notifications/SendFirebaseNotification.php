<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Kutia\Larafirebase\Messages\FirebaseMessage;

class SendFirebaseNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(protected $device_tokens,protected $title, protected $body)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['firebase','database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toFirebase($notifiable)
    {
        return (new FirebaseMessage)
            ->withTitle($this->title, $notifiable->first_name)
            ->withBody($this->body)
            ->asNotification($this->device_tokens); // OR ->asMessage($deviceTokens);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'user_id' => Auth::id(),
        ];
    }
}
