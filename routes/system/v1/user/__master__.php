<?php

use Illuminate\Support\Facades\Route;

Route::prefix('user')->group(function() {

    include_once 'account.php';

});
