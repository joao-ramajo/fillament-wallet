<?php

namespace App\Http\Controllers\Auth;

use App\Action\Auth\LoginAction;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DomainException;

class LoginController extends Controller
{
    public function __construct(
        protected readonly LoginAction $loginAction
    ) {
    }

    public function __invoke(Request $request)
    {
        try {
            $credentials = $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required'],
                'remember' => ['nullable', 'boolean'],
            ]);

            $result = $this->loginAction->execute($credentials);

            return response()->json([
                'message' => 'Login realizado com sucesso.',
                'user' => [
                    'name' => $result['name'],
                ],
                'token' => $result['token'],
            ], 200);
        } catch (DomainException $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 400);
        }
    }
}
