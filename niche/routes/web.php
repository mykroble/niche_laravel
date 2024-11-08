<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormController;

Route::get('/', function () {
    return view('helloWorld'); // This refers to resources/views/test.blade.php
});


Route::get('/name-form', [FormController::class, 'showForm'])->name('name.form');
Route::post('/name-form', [FormController::class, 'handleForm'])->name('name.submit');