<?php

namespace App\Listeners;

use App\Events\OrderCreateEvent;
use App\Mail\OrderCreateMail;
use Illuminate\Support\Facades\Mail;

class OrderCreateListener
{

    public function handle(OrderCreateEvent $event)
    {
        Mail::to(config('mail.address.admin'))->send(new OrderCreateMail($event->order));
    }
}
