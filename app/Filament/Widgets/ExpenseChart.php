<?php

namespace App\Filament\Widgets;

use App\Models\Expense;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\Auth;

class ExpenseChart extends ChartWidget
{
    protected ?string $heading = 'Expenses by Status';

    protected function getData(): array
    {
        // Define os status que queremos comparar
        $statuses = ['paid', 'pending', 'overdue'];

        // Soma os valores de cada status para o usuário atual
         $data = array_map(fn($status) =>
            Expense::where('user_id', Auth::id())
                ->where('status', $status)
                ->count(),
            $statuses
        );

        // Retorna no formato esperado pelo Chart.js
        return [
            'datasets' => [
                [
                    'label' => '',
                    'data' => $data,
                    'backgroundColor' => [
                        '#22c55e', // paid - verde
                        '#facc15', // pending - amarelo
                        '#ef4444', // overdue - vermelho
                    ],
                ],
            ],
            'labels' => array_map('ucfirst', $statuses),
        ];
    }

    protected function getType(): string
    {
        return 'bar'; // ou 'pie' se preferir
    }
}
