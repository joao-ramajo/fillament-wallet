<?php

namespace App\Filament\Resources\Expenses\Widgets;

use App\Models\Expense;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TotalExpensesOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $total_expenses = Expense::where('type', 'expense')->sum('amount');

        return [
            Stat::make('Total Widgert', 'R$ ' . number_format($total_expenses / 100, 2, ',', '.'))
                ->description('Total amount of all expenses')
                ->descriptionIcon('heroicon-m-arrow-trending-down')
                ->color('danger'),
        ];
    }
}
