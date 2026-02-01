<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Dashboard\GetExpensesController;
use App\Http\Controllers\Dashboard\GetSummaryController;
use App\Http\Controllers\Expense\CreateExpenseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post("/expenses", CreateExpenseController::class)->middleware(['auth:sanctum'])->name('api.expenses.create');
Route::post('/register', RegisterController::class)->name('api.register');
Route::post('/login', LoginController::class)->name('api.login');
Route::get('/dashboard/summary', GetSummaryController::class)->middleware([
    'auth:sanctum'
])->name('api.get-summary');
Route::get('/dashboard/expenses', GetExpensesController::class)->middleware([
    'auth:sanctum'
])->name('api.get-expenses');