<?php
use App\Http\Controllers\SocialAuthController;

Route::prefix('auth')->group(function () {
    
Route::get('google', [SocialAuthController::class, 'googleRedirect'])->name('googlelogin');
Route::get('google/callback', [SocialAuthController::class, 'googleCallback'])->name('googlecallback');

Route::get('facebook', [SocialAuthController::class, 'facebookRedirect'])->name('facebooklogin');
Route::get('facebook/callback', [SocialAuthController::class, 'facebookCallback'])->name('facebookcallback');
});