<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ApplicationFormRevised extends Notification
{
    use Queueable;
    public $firstName;
    public $lastName;
    public $department;
    public $college;
    public $branch;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($firstName, $lastName, $department, $college, $branch)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->department = $department;
        $this->college = $college;
        $this->branch = $branch;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
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
                    ->line("We've successfully received your revised application requests.")
                    ->line('Please wait for your schedule in submitting your hard copied requirements.');
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
            'data' => '<b>Application form revised by '.$this->firstName.' '.$this->lastName.'</b> and friends from <i>'.$this->department.'-'.$this->college.'-'.$this->branch.'</i>'
        ];
    }
}
