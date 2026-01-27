<?php

namespace App\Http\Controllers\Expense;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class ShowExpenseEditController extends Controller
{
    public function __invoke(string $id)
    {
        $id = Crypt::decrypt($id);

        $userId = Auth::id();

        $expense = DB::table('expenses')
            ->leftJoin('categories', 'expenses.category_id', '=', 'categories.id')
            ->where('expenses.id', $id)
            ->where('expenses.user_id', $userId)
            ->select(
                'expenses.id',
                'expenses.title',
                'categories.name as category',
                'expenses.amount',
                'expenses.payment_date',
                'expenses.due_date',
                'expenses.type',
                'expenses.status',
                'expenses.created_at'
            )
            ->first();

        if (!$expense) {
            abort(404);
        }

        #$expense->amount = number_format($expense->amount / 100, 2, ',', '.');

        $expense->payment_date = $expense->payment_date
            ? Carbon::parse($expense->payment_date)->format('d/m/Y')
            : null;

        $expense->due_date = $expense->due_date
            ? Carbon::parse($expense->due_date)->format('d/m/Y')
            : null;

        $categories = Category::all();

        return view('expense.edit', compact('expense', 'categories'));
    }
}
