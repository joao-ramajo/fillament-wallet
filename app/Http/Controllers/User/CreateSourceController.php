<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Source;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CreateSourceController extends Controller
{
    public function __invoke(Request $request)
    {
        $user = Auth::user();

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'color' => ['required', 'string', 'size:7'],
            'allow_negative' => ['boolean'],
        ]);

        $source = Source::create([
            'user_id' => $user->id,
            'name' => $data['name'],
            'color' => $data['color'],
            'allow_negative' => $data['allow_negative'] ?? false,
            'is_default' => false,
        ]);

        return response()->json([
            'message' => 'Fonte criada com sucesso',
            'data' => $source,
        ], 201);
    }
}
