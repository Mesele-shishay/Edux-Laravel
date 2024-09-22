<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class WelcomeEmailNotfication extends Notification
{
    use Queueable;

    public $UserCredentials;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($UserCredentials)
    {
        $this->UserCredentials = $UserCredentials;
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
        $email = (string) $this->UserCredentials['email'];
        $password = (string) $this->UserCredentials['password'];
        // dd($password);

        return (new MailMessage)
                    ->from('Mesele25@edux.local')
                    ->line('Welcome to our application.')
                    ->action('Go home page', url('/'))
                    ->line('Thank you for using our application!')
                    ->line('Use bellow credentials to login to our system')
                    ->line("Email : $email")
                    ->line("Password : $password");


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
