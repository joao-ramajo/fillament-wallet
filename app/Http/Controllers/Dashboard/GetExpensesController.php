<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GetExpensesController extends Controller
{
    public function __invoke()
    {
        $user = Auth::user();

        $expenses = DB::table('expenses')
            ->leftJoin('categories', 'expenses.category_id', '=', 'categories.id')  // join opcional
            ->where('expenses.user_id', $user->id)
            ->orderBy('expenses.created_at', 'desc')
            ->select(
                'expenses.id',
                'expenses.title',
                'categories.name as category',
                'expenses.amount',
                'expenses.payment_date',
                'expenses.due_date',
                'expenses.type',
                'expenses.status',
            )
            ->get();

        return response()
            ->json($expenses->toArray());
    }
}
