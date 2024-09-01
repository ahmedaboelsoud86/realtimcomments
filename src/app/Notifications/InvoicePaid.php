<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Notifications\Messages\BroadcastMessage;


class InvoicePaid extends Notification implements ShouldQueue, ShouldBroadcast
{
    use Queueable;

    protected $comment;

    /**
     * Create a new notification instance.
     */
    public function __construct($comment)
    {
        $this->comment = $comment;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database', 'broadcast'];
    }

    // /**
    //  * Get the mail representation of the notification.
    //  */
    // public function toMail(object $notifiable): MailMessage
    // {
    //     return (new MailMessage)
    //         ->line('The introduction to the notification.' . $this->comment->post->title)
    //         ->action('Notification Action', route('show', $this->comment->post_id))
    //         ->line('Thank you for using our application!');
    // }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toDatabase(object $notifiable): array
    {
        return [
            'post_id' => $this->comment->post_id,
            'title' => $this->comment->post->title,
            'user' => $this->comment->user->name,
        ];
    }
    public function toBroadcast(object $notifiable)
    {
        return new BroadcastMessage([
            'data' => [
                'post_id' => $this->comment->post_id,
                'title' => $this->comment->post->title,
                'user' => $this->comment->user->name,
            ]
        ]);
    }
}
