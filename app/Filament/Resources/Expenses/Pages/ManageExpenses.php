<?php

namespace App\Filament\Resources\Expenses\Pages;

use App\Filament\Resources\Expenses\ExpenseResource;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageExpenses extends ManageRecords
{
    protected static string $resource = ExpenseResource::class;
    public bool $hideValues = false;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
            Action::make('toggle-values')
                ->label($this->hideValues ? 'Show values' : 'Hide values')
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
}
