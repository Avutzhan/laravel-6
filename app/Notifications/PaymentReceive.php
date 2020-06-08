<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\NexmoMessage;
use Illuminate\Notifications\Notification;

class PaymentReceive extends Notification
{
    use Queueable;

    public $amount;

    /**
     * PaymentReceive constructor.
     * @param $amount
     */
    public function __construct($amount)
    {
        $this->amount = $amount;
    }
    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database', 'nexmo'];
    }

    /**
     * @param $notifiable
     * @return MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('your laracast')
                    ->greeting('wats up')
                    ->line('The introduction to the notification.')
                    ->line('Lore ipsum amted dolot.')
                    ->action('Submit', url('/'))
                    ->line('Thanks');
    }

    /**
     * @param $notifiable
     * @return mixed
     */
    public function toNexmo($notifiable)
    {
        return (new NexmoMessage)
            ->content('Test LAracasts sms sending');
    }

    /**
     * @param $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'amount' => $this->amount
        ];
    }
}
