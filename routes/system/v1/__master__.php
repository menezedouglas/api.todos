<?php

use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function() {

    include_once 'user/__master__.php';

    include_once 'todos/__master__.php';

    include_once 'auth/__master__.php';

});
