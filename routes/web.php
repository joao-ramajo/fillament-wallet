<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Dashboard\ExpenseController;
use App\Http\Controllers\DashboardController;
use App\Services\ExportService;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('web.home');

Route::get('cadastro', function () {
    return view('register');
})->name('web.register');

Route::get('login', function () {
    return view('login');
})->name('web.login');

Route::get('funcionalidades', function () {
    return view('features');
})->name('web.features');

Route::get('termos-e-condicoes', function () {
    return view('termos-e-condicoes');
})->name('web.termos-e-condicoes');

Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('web.dashboard');

Route::prefix('api')->group(function () {
    Route::post('expense', [ExpenseController::class, 'create'])->name('api.expense.store');
    Route::post('login', [AuthController::class, 'login'])->name('api.login');
    Route::post('register', [AuthController::class, 'register'])->name('api.register');
    Route::post('logout', [AuthController::class, 'logout'])->name('api.logout');
    Route::post('import', [ExpenseController::class, 'import'])->name('api.import');
});

Route::get('export', [ExportService::class, 'execute'])->name('web.export');
