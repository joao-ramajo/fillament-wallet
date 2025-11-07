<?php

namespace App\Filament\Widgets;

use App\Models\Expense;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget;
use Illuminate\Support\Facades\Auth;

class TotalValuesOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $userId = Auth::id();

        $total_income = Expense::where('user_id', $userId)
            ->where('type', 'income')
            ->where('status', 'paid')
            ->sum('amount');

        $expected_income = Expense::where('user_id', $userId)
            ->where('type', 'income')
            ->where('status', 'pending')
            ->sum('amount');

        $total_expenses = Expense::where('user_id', $userId)
            ->where('status', 'paid')
            ->where('type', 'expense')
            ->sum('amount');

        $expected_expenses = Expense::where('user_id', $userId)
            ->where('status', '!=', 'paid')
            ->where('type', 'expense')
            ->sum('amount');

        $current_balance = $total_income - $total_expenses;
        $expected_balance = ($total_income + $expected_income) - ($total_expenses + $expected_expenses);
        return [
            Stat::make('Total Income', 'R$ ' . number_format($total_income / 100, 2, ',', '.'))
                ->description('Total of received incomes')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
            Stat::make('Total Expenses', 'R$ ' . number_format($total_expenses / 100, 2, ',', '.'))
                ->description('Total of all expenses')
                ->descriptionIcon('heroicon-m-arrow-trending-down')
                ->color('danger'),
            Stat::make('Current Balance', 'R$ ' . number_format($current_balance / 100, 2, ',', '.'))
                ->description('Incomes minus expenses (paid)')
                ->descriptionIcon(
                    $current_balance >= 0
                        ? 'heroicon-m-banknotes'
                        : 'heroicon-m-exclamation-triangle'
                )
                ->color($current_balance >= 0 ? 'success' : 'warning'),
            Stat::make('Expected Income', 'R$ ' . number_format($expected_income / 100, 2, ',', '.'))
                ->description('Pending incomes to receive')
                ->descriptionIcon('heroicon-m-clock')
                ->color('info'),
            Stat::make('Expected Expenses', 'R$ ' . number_format($expected_expenses / 100, 2, ',', '.'))
                ->description('Upcoming expenses (not yet paid)')
                ->descriptionIcon('heroicon-m-exclamation-circle')
                ->color('warning'),
            Stat::make('Expected Balance', 'R$ ' . number_format($expected_balance / 100, 2, ',', '.'))
                ->description('Projected balance including pending incomes')
                ->descriptionIcon('heroicon-m-calculator')
                ->color($expected_balance >= 0 ? 'success' : 'warning'),
        ];
    }

    protected function getColumns(): int
    {
        return 3;
    }
}
