<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\UsersController;

Route::prefix('account')->group(function() {

    Route::post(
        'create',
        [
            UsersController::class,
            'store'
        ]
    );

});
