<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class AccountRequestRevision extends Notification
{
    use Queueable;
    public $firstName;
    public $message;
    public $accountId;
    public $revisionToken;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($firstName, $message, $accountId, $revisionToken)
    {
        $this->firstName = $firstName;
        $this->message = $message;
        $this->accountId = $accountId;
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
                    ->line('Dear, '.$this->firstName)
                    ->line($this->message)
                    ->action('To Revision Page', url('http://pipms.test/registration/author/'.$this->accountId.'/revision-form/'.$this->revisionToken))
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
