<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PostInteracted extends Notification
{
    use Queueable;

    protected $actor;
    protected $post;
    protected $type;
    protected $payload;

    /**
     * Create a new notification instance.
     */
    public function __construct($actor, $post, string $type, array $payload = [])
    {
        $this->actor   = $actor;
        $this->post    = $post;
        $this->type    = $type;
        $this->payload = $payload;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $url = url("/posts/{$this->post->id}");

        return (new MailMessage)
            ->subject('Someone interacted with your post')
            ->greeting("Hi {$notifiable->name},")
            ->line("{$this->actor->name} {$this->type}ed your post.")
            ->action('View Post', $url)
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
