<?php

declare(strict_types=1);

namespace App\Action\Auth;

use App\Events\UserRegistered;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterUserAction
{
    public function execute(array $data): array
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        event(new UserRegistered($user->name, $user->email));


        return ['name' => $user->name, 'token' => $token];
    }
}
