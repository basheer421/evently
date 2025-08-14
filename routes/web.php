<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ExploreController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SearchController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/reset-password', [AuthController::class, 'resetPassword'])->name('reset-password');
    Route::get('/explore', [ExploreController::class, 'index'])->name('explore');
    Route::get('/search', [SearchController::class, 'index'])->name('search');
});

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/login', [AuthController::class, 'loginPost'])->name('login.post');
    Route::post('/register', [AuthController::class, 'registerPost'])->name('register.post');
    Route::get('/reset-password', [AuthController::class, 'resetPassword'])->name('reset-password');

    Route::get('auth/google', [AuthController::class, 'googleRedirect'])->name('google.redirect');
    Route::get('auth/google/callback', [AuthController::class, 'handleGoogleCallback'])->name('google.callback');
});
