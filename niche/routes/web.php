<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BlogController;
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

Route::middleware('auth')->prefix('homepage')->group(function(){
    Route::get('/profile', [ProfileController::class, 'showProfPage'])->name('profile');
    Route::post('/profile', [ProfileController::class, 'handleProfileForm1'])->name('profileForm1.handle');
});

Route::middleware('auth')->prefix('blog')->group(function(){                // havent implemented yet.
    Route::get('/create', [BlogController::class, 'createBlogSubmit'])->name('createBlog');
    Route::post('/edit', [BlogController::class, 'editBlogSubmit'])->name('editBlog.submit');
    Route::post('/save', [BlogController::class, 'saveBlogSubmit'])->name('saveBlog.submit');
});
Route::get('/blog/view', [BlogController::class, 'viewBlog'])->name('viewBlog');     //maybe I should return the user ID so I can add the edit button if it's their own Blog.

Route::get('/login',[loginController::class, 'showLoginPage'])->name('login');
Route::post('/login',[loginController::class, 'handleLoginSubmit'])->name('loginForm.handle');
Route::post('/logout',[loginController::class, 'handleLogout'])->name('logout.submit');

Route::get('/registration',[RegistrationController::class, 'showRegistrationPage'])->name('registration');
Route::post('/registration', [RegistrationController::class, 'handleRegistrationSubmit'])->name('registrationForm.handle');

Route::get('/test', function(){
    return view('posteditor');
})->name('testPage');

