<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use Illuminate\Support\Facades\Auth;

class GetSourceDetailsController extends Controller
{
    public function __invoke()
    {
        $user = Auth::user();

        $sources = $user->sources()->get();

        $result = $sources->map(function ($source) use ($user) {
            $totalIncome = Expense::where('user_id', $user->id)
                ->where('source_id', $source->id)
                ->where('type', 'income')
                ->sum('amount');

            $totalExpense = Expense::where('user_id', $user->id)
                ->where('source_id', $source->id)
                ->where('type', 'expense')
                ->sum('amount');

            $expensesCount = Expense::where('user_id', $user->id)
                ->where('source_id', $source->id)
                ->count();

            return [
                'id' => $source->id,
                'name' => $source->name,
                'color' => $source->color,
                'expenses_count' => $expensesCount,
                'total_income' => $totalIncome,
                'total_expense' => $totalExpense,
                'balance' => $totalIncome - $totalExpense,
            ];
        });

        return response()->json($result);
    }
}
