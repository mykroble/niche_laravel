<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ChatController;
use Illuminate\Support\Facades\Auth;


Route::get('/', function(){
    if(!auth::check()){
        return redirect()->route('login');
    }
});

Route::get('/homepage', function(){
    if(auth::check()){
        return view('homepage');
    } else {
        return redirect()->route('login')->with('error', 'You must be logged in to access this page.');
    }
})->name('homepage');




Route::middleware('auth')->group(function () {
    Route::get('/message', [ChatController::class, 'index'])->name('message');
    Route::post('/message', [ChatController::class, 'store'])->name('message.store');
});




Route::middleware('auth')->prefix('homepage')->group(function(){
    Route::get('/profile', [ProfileController::class, 'showProfPage'])->name('profile');
    Route::post('/profile', [ProfileController::class, 'handleProfileForm1'])->name('profileForm1.handle');
});

Route::get('/login',[loginController::class, 'showLoginPage'])->name('login');
Route::post('/login',[loginController::class, 'handleLoginSubmit'])->name('loginForm.handle');
Route::get('/logout',[loginController::class, 'handleLogout'])->name('logout.submit');

Route::get('/registration',[RegistrationController::class, 'showRegistrationPage'])->name('registration');
Route::post('/registration', [RegistrationController::class, 'handleRegistrationSubmit'])->name('registrationForm.handle');

Route::get('/test', function(){
    return view('posteditor');
})->name('testPage');

