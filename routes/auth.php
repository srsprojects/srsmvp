<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SocialAuthController;

Route::prefix('auth')->group(function () {

Route::get('login', function () {
    return view('auth.login');
})->name('login');

Route::get('register', function () {
    return view('auth.register');
})->name('register');

Route::post('register', [AuthController::class, 'register'])->name('register');
Route::post('login', [AuthController::class, 'login'])->name('login');

Route::get('google', [SocialAuthController::class, 'googleRedirect'])->name('googlelogin');
Route::get('google/callback', [SocialAuthController::class, 'googleCallback'])->name('googlecallback');

Route::get('facebook', [SocialAuthController::class, 'facebookRedirect'])->name('facebooklogin');
Route::get('facebook/callback', [SocialAuthController::class, 'facebookCallback'])->name('facebookcallback');
});

Route::get('user/{phone}', [AuthController::class, 'getUser'])->name('getuserbyphone');
