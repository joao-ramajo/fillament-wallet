<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Expense;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();

        $expenses = DB::table('expenses')
            ->leftJoin('categories', 'expenses.category_id', '=', 'categories.id')  // join opcional
            ->where('expenses.user_id', $user->id)
            ->orderBy('expenses.created_at', 'desc')
            ->select(
                'expenses.title',
                'categories.name as category',  // nome da categoria, null se não tiver
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

        // Inicializa os valores
        $stats = [
            'total_receive' => 0,
            'total_expense' => 0,
            'expected_total' => 0,
        ];

        $userId = $user->id;

        // Total recebido (type = income e status = paid)
        $stats['total_receive'] = Expense::where('user_id', $userId)
            ->where('type', 'income')
            ->where('status', 'paid')
            ->sum('amount');

        // Total gasto (type = expense e status = paid)
        $stats['total_expense'] = Expense::where('user_id', $userId)
            ->where('type', 'expense')
            ->where('status', 'paid')
            ->sum('amount');

        // Total esperado = (entradas recebidas + entradas pendentes) - (despesas pagas + despesas pendentes)
        $total_income_pending = Expense::where('user_id', $userId)
            ->where('type', 'income')
            ->where('status', 'pending')
            ->sum('amount');

        $total_expense_pending = Expense::where('user_id', $userId)
            ->where('type', 'expense')
            ->where('status', 'pending')
            ->sum('amount');

        $stats['expected_total'] = ($stats['total_receive'] + $total_income_pending)
            - ($stats['total_expense'] + $total_expense_pending);

        // Formata os valores para reais (opcional)
        foreach ($stats as $key => $value) {
            $stats[$key] = 'R$ ' . number_format($value / 100, 2, ',', '.');
        }

        $categories = $this->getCategories();

        return view('dashboard', compact('expenses', 'stats', 'categories'));
    }

    private function getCategories()
    {
        return Category::where('user_id', Auth::id())->orWhereNull('user_id')->get();
    }
}
