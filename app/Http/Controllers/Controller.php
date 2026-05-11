<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;

abstract class Controller
{
    protected function authenticatedUserId(): int
    {
        $userId = Auth::id();

        throw_unless(is_int($userId), AuthenticationException::class);

        return $userId;
    }
}
