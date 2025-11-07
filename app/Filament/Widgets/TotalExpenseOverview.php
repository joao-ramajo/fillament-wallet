<?php

namespace App\Filament\Widgets;

use App\Models\Expense;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget;

class TotalExpenseOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $total_expenses = Expense::where('type', 'expense')->sum('amount');

        return [
          
        ];
    }
}
