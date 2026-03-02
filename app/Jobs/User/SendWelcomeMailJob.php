<?php

namespace App\Jobs\User;

use App\Mail\User\WelcomeMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use App\Support\Logging\FormatsLogMessage;
use Illuminate\Support\Facades\Mail;
use Psr\Log\LoggerInterface;

class SendWelcomeMailJob implements ShouldQueue
{
    use Queueable;
    use FormatsLogMessage;

    public function __construct(
        public string $name,
        public string $email,
    ) {
    }

    public function handle(LoggerInterface $logger): void
    {
        Mail::to($this->email)->send(new WelcomeMail($this->name));
        $logger->info($this->formatLogMessage('welcome email sent'), [
            'email' => $this->email,
        ]);
    }
}
