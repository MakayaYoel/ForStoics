<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'home']);

Route::middleware(Authenticate::class)->group(function() {
    Route::get('/logout', [UserController::class, 'logout']);
    Route::get('/user/manage-profile', [UserController::class, 'manage_profile']);
    Route::put('/user/manage-profile/profile-picture', [UserController::class, "changeProfilePicture"]);

    Route::get('/posts/create', [PostController::class, 'create']);
    Route::post('/posts', [PostController::class, 'store']);
    Route::get('/posts/{post}/edit', [PostController::class, 'edit']);
    Route::put('/posts/{post}', [PostController::class, 'update']);
    Route::delete('/posts/{post}', [PostController::class, 'destroy']);
    Route::post('/posts/{post}/like', [PostController::class, 'attemptLike']);

    Route::post('/posts/{post}/report', [PostController::class, 'reportPost']);
});

Route::middleware(RedirectIfAuthenticated::class)->group(function() {
    Route::get('/register', [UserController::class, 'register']);
    Route::post('/register', [UserController::class, 'store']);

    Route::get('/login', [UserController::class, 'login'])->name('user.login');
    Route::post('/login', [UserController::class, 'attemptLogin']);
});

Route::get('/posts', [PostController::class, 'index']);
Route::get('/posts/{post}', [PostController::class, 'show']);
Route::get('/user/{user}', [UserController::class, 'show']);
Route::get('/user/{user}/posts', [UserController::class, 'showPosts']);
Route::get('/search', [HomeController::class, 'search']);