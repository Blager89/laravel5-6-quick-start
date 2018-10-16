<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewPassword extends Notification
{
    use Queueable;

    /**
     * New password
     *
     * @var string
     */
    public $new_password;

    /**
     * Create a new notification instance.
     *
     * @param  string $new_password
     */
    public function __construct($new_password)
    {
        $this->new_password = $new_password;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed $notifiable
     *
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed $notifiable
     *
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Password Reset Request')
            ->greeting('Password Reset')
            ->line('You are receiving this email because we received a password reset request for your account.')
            ->line("Your new password is: {$this->new_password}")
            ->line('Use it for your next sign in to the application');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed $notifiable
     *
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
