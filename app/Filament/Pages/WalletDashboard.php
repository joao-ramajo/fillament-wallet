<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\TotalValuesOverview;
use Filament\Pages\Page;

class WalletDashboard extends Page
{
    protected static string $routePath = '/';

    protected string $view = 'filament.pages.wallet-dashboard';

    public static function getNavigationLabel(): string
    {
        return 'Dashboard';
    }

    public static function getNavigationIcon(): string
    {
        return 'heroicon-o-chart-bar';
    }

    protected function getFooterWidgets(): array
    {
        return [
            TotalValuesOverview::class,
        ];
    }
}
