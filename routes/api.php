<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Dashboard\GenerateExpenseCsv;
use App\Http\Controllers\Dashboard\GetExpensesController;
use App\Http\Controllers\Dashboard\GetSummaryController;
use App\Http\Controllers\Expense\CreateExpenseController;
use App\Http\Controllers\Expense\getCategoryListController;
use App\Http\Controllers\Expense\UpdateExpenseController;
use Illuminate\Support\Facades\Route;

Route::post('/expenses', CreateExpenseController::class)->middleware(['auth:sanctum'])->name('api.expenses.create');
Route::put('/expenses/{id}', UpdateExpenseController::class)->middleware(['auth:sanctum'])->name('api.expenses.update');
Route::get('/categories', getCategoryListController::class)->middleware(['auth:sanctum'])->name('api.categories.list');
Route::post('/register', RegisterController::class)->name('api.register');
Route::post('/login', LoginController::class)->name('api.login');
Route::get('/dashboard/summary', GetSummaryController::class)->middleware([
    'auth:sanctum'
])->name('api.get-summary');
Route::get('/dashboard/expenses', GetExpensesController::class)->middleware([
    'auth:sanctum'
])->name('api.get-expenses');
Route::get('/dashboard/spreadsheet/csv/export', GenerateExpenseCsv::class)->middleware(['auth:sanctum'])->name('api.csv.export');