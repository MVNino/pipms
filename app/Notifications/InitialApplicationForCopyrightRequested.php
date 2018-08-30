<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class InitialApplicationForCopyrightRequested extends Notification
{
    use Queueable;
    public $firstname;
    public $lastname;
    public $department;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($firstname, $lastname, $department)
    {
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->department = $department;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
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
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
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
            'data' => '<b>Initial request for copyright registration </b>was submitted by <b>'.$this->firstname.' '.$this->lastname.' from <i>'.$this->department->char_department_code.'-'.$this->department->college->char_college_code.'-'.$this->department->college->branch->str_branch_name.'</i>'
        ];
    }
}
