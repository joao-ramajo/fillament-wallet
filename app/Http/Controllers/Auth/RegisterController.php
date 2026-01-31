<?php

namespace App\Http\Controllers\Auth;

use App\Domain\Exceptions\AuthException;
use App\Events\UserRegistered;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use DomainException;

class RegisterController extends Controller
{
    public function __invoke(RegisterRequest $request)
    {
        try {
            $data = $request->validated();

            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);

            $token = $user->createToken('auth_token')->plainTextToken;

            event(new UserRegistered($user->name, $user->email));

            return response()->json([
                'message' => 'Conta registrada com sucesso.',
                'user' => [
                    'name' => $user->name,
                ],
                'token' => $token,
            ], 201);
        } catch (DomainException $e) {
            return response()
                ->json([
                    'message' => $e->getMessage()
                ], 400);
        }
    }
}
