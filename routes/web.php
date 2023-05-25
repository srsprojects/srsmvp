<?php

use App\Http\Controllers\DepositController;
use App\Http\Controllers\RecyclableController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\WithdrawController;
use Illuminate\Support\Facades\Route;

require __DIR__.'/auth.php';
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect(route('dashboard'));
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::resource('recyclables', RecyclableController::class);
    Route::prefix('wallets')->group(function (){
        Route::get('/', [WalletController::class, 'index'])->name('wallets.index');
        Route::resource('deposit', DepositController::class);
        Route::resource('withdraw', WithdrawController::class);
    });
    Route::get('transactions/recyclables', [TransactionController::class, 'recyclables']);
    Route::resource('transactions', TransactionController::class);
});