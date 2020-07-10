<?php

namespace App\Listeners;

use App\Events\OrderDeleteEvent;
use App\Mail\OrderDeleteMail;
use Illuminate\Support\Facades\Mail;

class OrderDeleteListener
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
     * @param  OrderDeleteEvent  $event
     * @return void
     */
    public function handle(OrderDeleteEvent $event)
    {

        if (auth()->user()->isAdmin()) {
            $email = $event->order->orderUser->email;
        } else {
            $email = config('mail.address.admin');
        }

        Mail::to($email)->send(new OrderDeleteMail($event->order));
    }
}
