<?php

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

Route::get('/', function () {
    return view('homepage');
});

Route::middleware(Authenticate::class)->group(function() {
    Route::get('/logout', [UserController::class, 'logout']);
    Route::get('/user/manage-profile', [UserController::class, 'manage_profile']);
});

Route::middleware(RedirectIfAuthenticated::class)->group(function() {
    Route::get('/register', [UserController::class, 'register']);
    Route::post('/register', [UserController::class, 'store']);

    Route::get('/login', [UserController::class, 'login'])->name('user.login');
    Route::post('/login', [UserController::class, 'attemptLogin']);
});