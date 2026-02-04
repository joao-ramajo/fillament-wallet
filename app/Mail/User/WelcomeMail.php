<?php

namespace App\Mail\User;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    const LINK = 'http://localhost:8080/';

    public function __construct(
        public string $name,
    ) {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Bem vindo a Fillament Wallet',
        );
    }


    public function content(): Content
    {
        return new Content(
            view: 'mail.welcome',
            with: [
                'name' => $this->name,
                'link' => self::LINK,
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
