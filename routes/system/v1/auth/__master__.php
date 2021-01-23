<?php

use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function() {

    include_once 'auth.php';

});
