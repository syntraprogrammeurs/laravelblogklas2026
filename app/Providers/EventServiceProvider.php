<?php

namespace App\Providers;

use App\Events\ContactMessageSent;
use App\Listeners\SendContactMessageMail;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        ContactMessageSent::class => [
            SendContactMessageMail::class,
        ],
    ];

    public function boot(): void
    {
        //
    }
}
