<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\ProfileController;

use App\Http\Controllers\BlogController;
use App\Http\Controllers\BookmarksController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\ExploreController;
use App\Http\Controllers\AdminController;

use App\Http\Controllers\ChatController;

use Illuminate\Support\Facades\Auth;


Route::get('/', function(){
    if(!auth::check()){
        return redirect()->route('login');
    } else {
        return redirect()->route('homepage');
    }
});
Route::middleware('auth')->group(function () {
    Route::get('/homepage', [HomepageController::class, 'loadHomepage'])->name('homepage');
    Route::get('/explore', [ExploreController::class, 'loadExplore'])->name('explore');
    Route::post('/explore', [ExploreController::class, 'joinChannel'])->name('channel.join');
});
Route::middleware('auth')->group(function () {
    Route::post('/bookmark', [HomepageController::class, 'bookmarkBlog'])->name('bookmark.blog');
    Route::get('/bookmarks', [HomepageController::class, 'showBookmarks'])->name('bookmarks');
    Route::post('/bookmarks/remove', [BookmarksController::class, 'removeBookmark'])->name('bookmarks.remove');
    Route::post('/bookmarks/add', [BookmarksController::class, 'addBookmark'])->name('bookmarks.add');
    Route::post('/bookmarks/toggle', [BookmarksController::class, 'toggleBookmark'])->name('bookmarks.toggle');
});

// Route::middleware('admin')->group(function() {
// });
//these are all protected of access inside the controller, no worries.
Route::get('/admin', [AdminController::class, 'loadAdminPage'])->name('adminPage');
Route::get('/admin/user/{id}', [AdminController::class, 'loadUserPosts'])->name('admin.userDetail');
Route::get('/admin/blog/{id}', [AdminController::class, 'viewUserPost'])->name('admin.viewPost');
Route::get('/admin/blog/{id}/ban', [AdminController::class, 'toggleBanPost'])->name('admin.toggleBanPost');
Route::get('/admin/user/{id}/ban', [AdminController::class, 'toggleBanUser'])->name('admin.toggleBanUser');


Route::middleware('auth')->group(function () {
    Route::get('/message', [ChatController::class, 'index'])->name('message');
    Route::post('/message', [ChatController::class, 'store'])->name('message.store');
    Route::get('/messages/user', [ChatController::class, 'fetchUserMessages'])->name('message.user');
});
Route::middleware('auth')->get('/message/new', [ChatController::class, 'getNewMessages'])->name('message.new');




Route::middleware('auth')->prefix('homepage')->group(function() {
    Route::get('/profile', [ProfileController::class, 'showProfPage'])->name('profile');
    Route::post('/profile', [ProfileController::class, 'handleProfileForm1'])->name('profileForm1.handle');
    Route::delete('/post/{id}', [ProfileController::class, 'destroy'])->name('posts.delete');


});



Route::middleware('auth')->prefix('blog')->group(function(){                // havent implemented yet.
    Route::get('/create', [BlogController::class, 'createBlog'])->name('createBlog');
    Route::post('/edit', [BlogController::class, 'editBlogSubmit'])->name('editBlog.submit');
    Route::post('/save', [BlogController::class, 'saveBlogSubmit'])->name('saveBlog.submit');
    Route::post('/blogs/search', [BlogController::class, 'ajaxSearch'])->name('blogs.search');
    
    Route::post('/comment', [BlogController::class, 'createComment'])->name('blogs.comment');
});
Route::get('/blog/view/{value}', [BlogController::class, 'viewBlog'])->name('viewBlog');     //maybe I should return the user ID so I can add the edit button if it's their own Blog.


Route::get('/login',[loginController::class, 'showLoginPage'])->name('login');
Route::post('/login',[loginController::class, 'handleLoginSubmit'])->name('loginForm.handle');
Route::post('/logout',[loginController::class, 'handleLogout'])->name('logout.submit');

Route::get('/registration',[RegistrationController::class, 'showRegistrationPage'])->name('registration');
Route::post('/registration', [RegistrationController::class, 'handleRegistrationSubmit'])->name('registrationForm.handle');

// Route::get('/test', function(){
//     return view('posteditor');
// })->name('testPage');

