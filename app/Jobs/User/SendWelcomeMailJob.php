<?php

namespace App\Jobs\User;

use App\Mail\User\WelcomeMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendWelcomeMailJob implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public string $name,
        public string $email,
    ) {
    }

    public function handle(): void
    {
        Mail::to($this->email)->send(new WelcomeMail($this->name));
        Log::info('email enviado com sucesso para ' . $this->email);
    }
}
