<?php

use App\Services\ExportService;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('export', [ExportService::class, 'execute'])->name('web.export');