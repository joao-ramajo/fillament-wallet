<?php

namespace App\Http\Controllers\Auth;

use App\Events\UserRegistered;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
            'remember' => ['nullable']
        ]);

        $remember = $request->has('remember');

        if (Auth::attempt([
            'email' => $credentials['email'],
            'password' => $credentials['password']
        ], $remember)) {
            $request->session()->regenerate();
            return redirect()->route('web.dashboard');
        }

        return back()->withErrors([
            'email' => 'Credenciais inválidas.',
        ])->withInput();
    }

    public function register(Request $request)
    {
        // Validação dos campos
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => [
                'required',
                'confirmed',  // Confirmação com password_confirmation
                Password::min(8)  // mínimo 8 caracteres
                    ->mixedCase()  // precisa ter letra maiúscula e minúscula
                    ->letters()  // precisa ter pelo menos uma letra
                    ->numbers()  // precisa ter pelo menos um número
            ],
            'terms' => ['accepted'],  // Deve ser aceito (checkbox)
        ]);

        // Criar usuário
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        // Login automático
        Auth::login($user);

        event(new UserRegistered($user->name, $user->email));
        Log::info('evento disparado');

        // Redirecionar para dashboard personalizado
        return redirect()->route('web.dashboard');  // ajuste para sua rota
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(route('web.login'));
    }
}
