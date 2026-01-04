<?php

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

Route::get('export', [ExportService::class, 'execute'])->name('web.export');