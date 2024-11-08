<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\loginController;

Route::get('/',
    [loginController::class, 'showLoginPage']);

Route::post('/',
    [loginController::class, 'handleLoginSubmit'])->name('loginForm.handleSubmit');
Route::post('/logout',
    [loginController::class, 'handleLogout'])->name('logout.submit');

Route::get('/homepage', function(){
    return view('homepage');
});