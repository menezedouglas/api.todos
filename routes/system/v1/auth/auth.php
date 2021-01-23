<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;

Route::post(
    'login',
    [
        LoginController::class,
        'store'
    ]
);

Route::middleware('api.auth')->group(function() {

    Route::get(
        'check',
        [
            LoginController::class,
            'index'
        ]
    );

    Route::post(
        'logout',
        [
            LoginController::class,
            'destroy'
        ]
    );

});




