<?php

namespace App\Providers;

use App\Events\Auth\UserForgotPasswordEvent;
use App\Events\UserCreatedSendPasswordEvent;
use App\Listeners\Auth\UserForgotPasswordListener;
use App\Listeners\UserCreatedSendPasswordListener;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        UserForgotPasswordEvent::class => [ UserForgotPasswordListener::class ],
        UserCreatedSendPasswordEvent::class => [ UserCreatedSendPasswordListener::class ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
