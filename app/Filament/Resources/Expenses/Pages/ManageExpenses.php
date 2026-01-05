<?php

namespace App\Filament\Resources\Expenses\Pages;

use App\Filament\Resources\Expenses\ExpenseResource;
use App\Models\Expense;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;
use Illuminate\Support\Facades\Auth;

class ManageExpenses extends ManageRecords
{
    protected const NOTIFY_DURATION = 6000;
    protected const LOW_BALANCE = 100_000;
    protected const CRITICAL_BALANCE = 50_000;

    protected static string $resource = ExpenseResource::class;

    public bool $hideValues = false;

    public function getTitle(): string
    {
        return 'Finanças';
    }

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Novo')
                ->icon('heroicon-o-plus')
                ->color('primary')
                ->after(function () {
                    $this->notify();
                }),
            Action::make('toggle-values')
                ->label($this->hideValues ? 'Esconder valores' : 'Mostrar valores')
                ->icon($this->hideValues ? 'heroicon-m-eye' : 'heroicon-m-eye-slash')
                ->button()
                ->color('gray')
                ->action(fn() => $this->hideValues = !$this->hideValues),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            \App\Filament\Widgets\TotalValuesOverview::class,
        ];
    }

    private function notify()
    {
        $userId = Auth::id();

        $total_income = Expense::where('user_id', $userId)
            ->where('type', 'income')
            ->whereIn('status', ['paid', 'pending'])
            ->sum('amount');

        $total_expenses = Expense::where('user_id', $userId)
            ->where('type', 'expense')
            ->whereIn('status', ['paid', 'pending'])
            ->sum('amount');

        $current_balance = $total_income - $total_expenses;

        if ($current_balance < self::LOW_BALANCE) {
            \Filament\Notifications\Notification::make()
                ->title('Alerta de saldo baixo')
                ->body('O saldo da sua conta está ficando baixo. Por favor, acompanhe seus gastos.')
                ->icon('heroicon-o-exclamation-triangle')
                ->iconColor('warning')
                ->duration(self::NOTIFY_DURATION)
                ->send();
        } elseif ($current_balance < self::CRITICAL_BALANCE) {
            \Filament\Notifications\Notification::make()
                ->title('Alerta de saldo crítico')
                ->body('Seu saldo atingiu um nível crítico. É necessária atenção imediata.')
                ->icon('heroicon-o-bolt')
                ->iconColor('danger')
                ->duration(self::NOTIFY_DURATION)
                ->send();
        }
    }
}
