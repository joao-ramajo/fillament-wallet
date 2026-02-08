<?php

namespace App\Http\Controllers\Expense;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class GetCategoryListController extends Controller
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
            ->withSum([
            'expenses as expenses_total_amount' => function ($q) {
                $q->where('user_id', Auth::id());
            }
            ], 'amount')
            ->orderBy('name', 'asc')
            ->get();
    }
}
