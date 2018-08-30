<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ApplicantRequestsPatent extends Notification
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
                    ->line('Application for copyright registration was requested successfully!')
                    ->line("Please wait the administrator's further response for your application.");
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
            'data' => '<b>Copyright and Patent request</b> by <b>'.$this->firstname.' '.$this->lastname.'</b> of <i>'.$this->department->char_department_code.'-'.$this->department->college->char_college_code.'-'.$this->department->college->branch->str_branch_name.'</i>'
        ];
    }
}
