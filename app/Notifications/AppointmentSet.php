<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class AppointmentSet extends Notification
{
    use Queueable;
    public $schedule;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($schedule)
    {
        $this->schedule = $schedule;
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
                    ->line("Your request for your work's copyright registration has been approved!")
                    ->line('Please see us in our office and kindly bring the requirements.')
                    ->line('Your visiting schedule: '.$this->schedule)
                    ->line('Want to re-check our list of requirements?')
                    ->action('Copyright registration guide', url('http://127.0.0.1:8000/copyright/guide'))
                    ->line('Thank you for using our application!');
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
            'data' => 'Appointment for your actual submission of requirements for copyright registration: '.$this->schedule
        ];
    }
}
