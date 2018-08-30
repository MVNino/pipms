<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class RequestForOnlineCopyrightInitialApplicationAccepted extends Notification
{
    use Queueable;
    public $applicantId;
    public $firstName;
    public $applicationToken;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($id, $firstName, $applicationToken)
    {
        $this->applicantId = $id;
        $this->firstName = $firstName;
        $this->applicationToken = $applicationToken;
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
                    ->line('Good day '.$this->firstName.'!')
                    ->line('This email is with regards to your copyright application. We would like to inform you that your request for initial application for copyright registration has been approved.')
                    ->line('The link below will redirect you to your actual copyright application form')
                    ->action('Copyright application form', url('http://127.0.0.1:8000/copyright/'.$this->applicantId.'/main-form/'.$this->applicationToken));
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
