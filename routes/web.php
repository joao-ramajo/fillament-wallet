<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Dashboard\ExpenseController;
use App\Http\Controllers\Expense\CreateExpenseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Expense\ShowExpenseDetailsController;
use App\Http\Controllers\Expense\ShowExpenseEditController;
use App\Http\Controllers\Expense\UpdateExpenseController;
use App\Mail\User\WelcomeMail;
use App\Services\ExportService;
use Illuminate\Support\Facades\Mail;
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

Route::get('guia-de-uso', function () {
    return view('guia-de-uso');
})->name('web.guia-de-uso');

Route::get('apoie', function () {
    return view('apoie');
})->name('web.apoie');

Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('web.dashboard');

Route::get('despesa/{id}', ShowExpenseDetailsController::class)->name('web.expense.details');
Route::get('despesa/editar/{id}', ShowExpenseEditController::class)->name('web.expenses.edit');
Route::put('despesa/atualizar/{id}', UpdateExpenseController::class)->name('web.expenses.update');
Route::delete('despesa/excluir/{id}', ShowExpenseEditController::class)->name('web.expenses.destroy');

Route::prefix('api')->group(function () {
    Route::post('expense', CreateExpenseController::class)->name('web.expense.store');
    Route::post('login', [AuthController::class, 'login'])->name('api.login');
    Route::post('register', [AuthController::class, 'register'])->name('api.register');
    Route::post('logout', [AuthController::class, 'logout'])->name('api.logout');
    Route::post('import', [ExpenseController::class, 'import'])->name('api.import');
});

Route::get('export', [ExportService::class, 'execute'])->name('web.export');

Route::get('/teste-email', function () {
    $toEmail = 'joaoramajo744@gmail.com';

    // Mail::raw('Olá! Este é um email de teste enviado pelo Laravel.', function ($message) use ($toEmail) {
    //     $message->to($toEmail)
    //             ->subject('Teste de Email Laravel');
    // });

    Mail::to('joaoramajo744@gmail.com')->send(new WelcomeMail('João Ramajo'));

    return view('mail.welcome', [
        'name' => 'John doe',
        'link' => 'https://localhost:80808'
    ]);
});
