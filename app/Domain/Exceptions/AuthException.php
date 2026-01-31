<?php declare(strict_types=1);

namespace App\Domain\Exceptions;

use DomainException;

class AuthException extends DomainException
{
    public function __construct(string $message, int $code = 400)
    {
        parent::__construct($message, $code);
    }

    public static function EmailHasAlreadTaken(): self
    {
        return new self('Email não disponivel', 400);
    }
}
