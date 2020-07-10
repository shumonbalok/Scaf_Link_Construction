<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\OrderEvent' => [
            'App\Listeners\OrderShippedMail',
        ],
        'App\Events\OrderCreateEvent' => [
            'App\Listeners\OrderCreateListener',
        ],
        'App\Events\OrderDeleteEvent' => [
            'App\Listeners\OrderDeleteListener',
        ],
        'App\Events\OrderShippedEvent' => [
            'App\Listeners\OrderShippedListener',
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
