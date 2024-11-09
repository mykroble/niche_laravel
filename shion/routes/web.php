<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\loginController;
use Illuminate\Support\Facades\Auth;

Route::get('/login',
    [loginController::class, 'showLoginPage'])->name('login');
Route::post('/login',
    [loginController::class, 'handleLoginSubmit'])->name('loginForm.handleSubmit');
Route::post('/logout',
    [loginController::class, 'handleLogout'])->name('logout.submit');

Route::get('/', function(){
    return redirect()->route('homepage');
});
Route::get('/homepage', function(){
    if(auth::check()){
        return view('homepage');
    } else {
        return redirect()->route('login')->with('error', 'You must be logged in to access this page.');
    }
})->name('homepage');