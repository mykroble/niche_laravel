<?php

use Illuminate\Support\Facades\Route;

Route::get('/test', function () {
    return view('test'); // This refers to resources/views/test.blade.php
});
