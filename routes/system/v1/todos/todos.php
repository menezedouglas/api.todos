<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TodosController;

Route::get(
    '',
    [
        TodosController::class,
        'index'
    ]
);

Route::post(
    'create',
    [
        TodosController::class,
        'store'
    ]
);

Route::get(
    'show',
    [
        TodosController::class,
        'show'
    ]
);

Route::put(
    'update',
    [
        TodosController::class,
        'update'
    ]
);

Route::get(
    'delete',
    [
        TodosController::class,
        'destroy'
    ]
);
