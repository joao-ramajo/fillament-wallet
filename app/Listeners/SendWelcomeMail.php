<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use App\Jobs\User\SendWelcomeMailJob;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendWelcomeMail
{
    /**
     * Create the event
     */
    public function __construct()
    {
        //
    }

    /**dd
     * Handle the event.
     */
    public function handle(UserRegistered $event): void
    {
        SendWelcomeMailJob::dispatch($event->name, $event->email);
    }
}
