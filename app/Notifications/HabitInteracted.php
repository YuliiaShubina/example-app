<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Habit;
use App\Models\User;
use App\Models\Comment;

class HabitInteracted extends Notification
{
    use Queueable;

    public string $type;
    public User $actor;
    public Habit $habit;
    public ?Comment $comment;

    /**
     * Create a new notification instance.
     */
    public function __construct(User $actor, Habit $habit, string $type, Comment $comment = null)
    {
        $this->actor   = $actor;
        $this->habit   = $habit;
        $this->type    = $type;
        $this->comment = $comment;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toDatabase(object $notifiable): array
    {
        return [
            'type'          => $this->type, 
            'actor_id'      => $this->actor->id,
            'actor_name'    => $this->actor->name,
            'habit_id'      => $this->habit->id,
            'habit_goal'    => $this->habit->goal,
            'comment_id'    => $this->comment?->id,
            'comment_body'  => $this->comment?->body,
        ];
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
