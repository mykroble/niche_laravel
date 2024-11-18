<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;


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

Route::get('/login',[loginController::class, 'showLoginPage'])->name('login');
Route::post('/login',[loginController::class, 'handleLoginSubmit'])->name('loginForm.handle');
Route::post('/logout',[loginController::class, 'handleLogout'])->name('logout.submit');

Route::get('/registration',[RegistrationController::class, 'showRegistrationPage'])->name('registration');
Route::post('/registration', [RegistrationController::class, 'handleRegistrationSubmit'])->name('registrationForm.handle');

Route::get('/profile', [ProfileController::class, 'showProfPage'])->name('profile');
Route::post('/profile', [ProfileController::class, 'handleProfileForm1'])->name('profileForm1.handle');

Route::get('/sample', function(){
    return view('sample');
})->name('samplePage');