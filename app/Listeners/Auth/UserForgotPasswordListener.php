<?php

namespace App\Listeners\Auth;

use App\Events\Auth\UserForgotPasswordEvent;
use App\Notifications\Auth\UserForgotPasswordNotification;

class UserForgotPasswordListener
{
    /**
     * Handle the event.
     *
     * @param  UserForgotPasswordEvent  $event
     * @return void
     */
    public function handle(UserForgotPasswordEvent $event)
    {
        $event->user->notify(new UserForgotPasswordNotification($event->token));
    }
}
