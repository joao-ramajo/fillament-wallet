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
            ->leftJoin('categories', 'expenses.category_id', '=', 'categories.id')
            ->join('sources', 'expenses.source_id', '=', 'sources.id')
            ->where('expenses.user_id', $user->id)
            ->orderBy('expenses.created_at', 'desc')
            ->select(
                'expenses.id',
                'expenses.title',
                'categories.name as category',
                'categories.id as category_id',
                'expenses.amount',
                'expenses.payment_date',
                'expenses.due_date',
                'expenses.type',
                'expenses.status',
                'expenses.source_id',
                'sources.name as source_name',
            )
            ->get();

        return response()
            ->json($expenses->toArray());
    }
}
