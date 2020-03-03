<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Subscriper;

class SubscriperNotification extends Notification implements ShouldQueue {

    use Queueable;

    private $subscriper;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Subscriper $subcriper) {
        $this->subscriper = $subcriper;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable) {
        return ['database', 'broadcast']; //type notification use pusher (braodcast) and data base tabe
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable) {
        return [
            'email' => $this->subscriper->email,
            'message' => 'You have a new Subscriper user',
        ];
    }

    public function toBroadcast($notifiable) { //data send to pusher 
        return [
            'id' => $this->id,
            'read_at' => null,
            'data' => [
                'email' => $this->subscriper->email,
                'message' => 'You have a new Subscriper user',
            ],
        ];
    }

}
