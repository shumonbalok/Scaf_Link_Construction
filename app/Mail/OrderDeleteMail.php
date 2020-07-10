<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderDeleteMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order)
    {
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if (auth()->user()->isAdmin()) {
            $email = config('mail.address.admin');
        } else {
            $email = $this->order->orderUser->email;
        }
        return $this->from($email)->markdown('emails.orders.order-delete');
    }
}
