<?php

namespace App\Listeners;

use App\Events\OrderShippedEvent;
use App\Mail\OrderShippedMail;
use Illuminate\Support\Facades\Mail;

class OrderShippedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  OrderShippedEvent  $event
     * @return void
     */
    public function handle(OrderShippedEvent $event)
    {
        if (auth()->user()->isAdmin()) {
            $email = $event->order->orderUser->email;
        } else {
            $email = config('mail.address.admin');
        }

        Mail::to($email)->send(new OrderShippedMail($event->order));
    }
}
