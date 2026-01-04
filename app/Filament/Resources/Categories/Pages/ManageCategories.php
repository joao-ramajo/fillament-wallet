<?php

namespace App\Filament\Resources\Categories\Pages;

use App\Filament\Resources\Categories\CategoryResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;
use Filament\Support\Icons\Heroicon;

class ManageCategories extends ManageRecords
{
    protected static string $resource = CategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Nova categoria')
                ->icon(Heroicon::OutlinedPlus)
                ->color('primary')
                ->tooltip('Criar uma nova categoria')
                ->modalHeading('Nova categoria')
                ->modalSubheading('Adicione uma nova categoria para organizar suas finanças'),
        ];
    }
}
