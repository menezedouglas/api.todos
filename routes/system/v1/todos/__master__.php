<?php

use Illuminate\Support\Facades\Route;

Route::prefix('todos')
    ->middleware('api.auth')
    ->group(function() {

    include_once 'todos.php';

});
