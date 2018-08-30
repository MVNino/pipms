<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class RequestRevision extends Notification
{
    use Queueable;
    public $copyrightId;
    public $firstName;
    public $message;
    public $revisionToken;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($copyrightId, $firstName, $message, $revisionToken)
    {
        $this->copyrightId = $copyrightId;
        $this->firstName = $firstName;
        $this->message = $message;
        $this->revisionToken = $revisionToken;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('Good day '.$this->firstName.'! ')
                    ->line('This email is with regards to your copyright application. We would like to inform you that your application is up for revision.')
                    ->line($this->message)
                    ->action('Request form to revise', url('http://127.0.0.1:8000/copyright/'.$this->copyrightId.'/revise/'.$this->revisionToken))
                    ->line('Please respond at your earliest convenience.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
