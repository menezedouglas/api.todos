<?php

use Illuminate\Support\Facades\Route;

Route::prefix('system')->group(function() {

    //API Version 1
    include_once 'v1/__master__.php';

});
