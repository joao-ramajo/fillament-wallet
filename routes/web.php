<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()
        ->json([
            'message' => 'Bem vindo ao Koda API'
        ]);
});
