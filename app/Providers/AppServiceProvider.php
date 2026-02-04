<?php

namespace App\Providers;

use App\Domain\Uuid;
use App\Models\Expense;
use App\Observers\ExpenseObserver;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Route::bind('uuid', function (string $value) {
            return new Uuid($value);
        });
    }
}
