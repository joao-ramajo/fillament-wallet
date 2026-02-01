<?php

namespace App\Http\Controllers\Expense;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class getCategoryListController extends Controller
{
    public function __invoke()
    {
        return Category::query()
            ->where(function ($q) {
                $q->where('user_id', Auth::id())
                  ->orWhereNull('user_id');
            })
            ->withCount([
                'expenses as expenses_count' => function ($q) {
                    $q->where('user_id', Auth::id());
                }
            ])
            ->orderBy('name', 'asc')
            ->get();
    }
}
