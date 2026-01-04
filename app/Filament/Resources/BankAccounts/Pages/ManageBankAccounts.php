<?php

namespace App\Filament\Resources\BankAccounts\Pages;

use App\Filament\Resources\BankAccounts\BankAccountResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;
use Filament\Support\Icons\Heroicon;

class ManageBankAccounts extends ManageRecords
{
    protected static string $resource = BankAccountResource::class;

protected function getHeaderActions(): array
{
    return [
        CreateAction::make()
            ->label('Nova conta bancária')
            ->icon(Heroicon::OutlinedPlus)
            ->color('primary')
            ->tooltip('Clique para criar uma nova conta bancária')
            ->modalHeading('Nova conta bancária')
            ->modalSubheading('Adicione uma nova conta para gerenciar seus saldos e transações'),
    ];
}
}
