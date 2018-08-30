<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class AuthorReadyForRegistration extends Notification
{
    use Queueable;
    public $applicantId;
    public $firstName;
    public $registrationToken;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($id, $firstName, $registrationToken)
    {
        $this->applicantId = $id;
        $this->firstName = $firstName;
        $this->registrationToken = $registrationToken;
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
                    ->line('Dear '.$this->firstName.', ')
                    ->line('We would like to inform you that your request for an author account has been approved.')
                    ->line('The link below will redirect you to your actual account registration form')
                    ->action('Account Registration Form', url('http://127.0.0.1:8000/registration/author/'.$this->applicantId.'/form/'.$this->registrationToken));
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
