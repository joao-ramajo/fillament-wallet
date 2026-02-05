<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GetSummaryController extends Controller
{
    public function __invoke()
    {
        $user = Auth::user();

        $defaultSourceId = $user->sources()
            ->where('is_default', true)
            ->value('id');

        $expenses = DB::table('expenses')
            ->leftJoin('categories', 'expenses.category_id', '=', 'categories.id')
            ->join('sources', 'expenses.source_id', '=', 'sources.id')
            ->where('expenses.user_id', $user->id)
            ->where('sources.id', $defaultSourceId)
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

        foreach ($expenses as $expense) {
            if ($expense->payment_date) {
                $expense->payment_date = Carbon::parse($expense->payment_date)->format('m/d/Y');
            }

            if ($expense->due_date) {
                $expense->due_date = Carbon::parse($expense->due_date)->format('m/d/Y');
            }
            if ($expense->amount !== null) {
                $expense->amount = 'R$ ' . number_format($expense->amount / 100, 2, ',', '.');
            }
        }

        $stats = [
            'total_receive' => 0,
            'total_expense' => 0,
            'expected_total' => 0,
        ];

        $userId = $user->id;

        $stats['total_receive'] = Expense::where('user_id', $userId)
            ->where('type', 'income')
            ->where('status', 'paid')
            ->where('source_id', $defaultSourceId)
            ->sum('amount');

        $stats['total_expense'] = Expense::where('user_id', $userId)
            ->where('type', 'expense')
            ->where('status', 'paid')
            ->where('source_id', $defaultSourceId)
            ->sum('amount');

        $total_income_pending = Expense::where('user_id', $userId)
            ->where('type', 'income')
            ->where('status', 'pending')
            ->where('source_id', $defaultSourceId)
            ->sum('amount');

        $total_expense_pending = Expense::where('user_id', $userId)
            ->where('type', 'expense')
            ->where('source_id', $defaultSourceId)
            ->where('status', 'pending')
            ->sum('amount');

        $stats['expected_total'] = ($stats['total_receive'] + $total_income_pending)
            - ($stats['total_expense'] + $total_expense_pending);

        return response()
            ->json([
                'total_receive' => $stats['total_receive'],
                'total_expense' => $stats['total_expense'],
                'expected_total' => $stats['expected_total']
            ]);
    }
}
