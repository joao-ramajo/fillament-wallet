<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Events\UserRegistered;
use App\Jobs\User\SendWelcomeMailJob;

class SendWelcomeMail
{
    public function handle(UserRegistered $event): void
    {
        dispatch(new SendWelcomeMailJob($event->name, $event->email));
    }
}
