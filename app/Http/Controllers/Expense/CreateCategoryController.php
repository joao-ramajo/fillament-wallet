<?php

namespace App\Http\Controllers\Expense;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DomainException;

class CreateCategoryController extends Controller
{
    public function __invoke(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'color' => 'required'
            ]);

            if (Category::whereName($request->input('name'))->whereUserId(Auth::id())->exists()) {
                throw new DomainException('Categoria já registrada.');
            }

            Category::create([
                'name' => $request->input('name'),
                'user_id' => Auth::id(),
                'color' => $request->input('color')
            ]);

            return response()
                ->json([
                    'message' => 'Categoria registrada com sucesso.'
                ], 201);
        } catch (DomainException $e) {
            return response()
                ->json([
                    'message' => $e->getMessage()
                ], 400);
        }
    }
}
