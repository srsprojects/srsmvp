<?php

use App\Http\Controllers\RecyclableController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReferralController;
use App\Http\Controllers\TransactionController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('v1')->group(function () {
    //No auth Routes
    Route::prefix('auth')->controller(AuthController::class)->group(function () {
        //API route for register new user
        Route::post('/register', 'register');
        //API route for login user
        Route::post('/login', 'login');

        Route::get('/check', 'checkAuth');
    });

    //Declare Webhooks here
    Route::prefix('webhook')->group(function (){
        Route::post('paystack', 'App\Http\Controllers\TransactionController@paystackhook')->name('paystackhook');
        Route::post('/flwhook', 'App\Http\Controllers\TransactionController@flwhook')->name('flwhook');
        Route::post('ussd', 'App\Http\Controllers\USSD\DefaultGate@USSDoutlet')->name('ussdcallback');
    });

    //Auth Protected Routes
    Route::group(['middleware' => ['auth:sanctum']], function () {

        Route::prefix('auth')->controller(AuthController::class)->group(function () {
            Route::get('/user', function (Request $request) {
                return auth()->user();
            });
            
            // API route for logout user
            Route::post('/logout', [AuthController::class, 'logout']);
        });

        //API Routes for Resource Controllers
        Route::prefix('referrals')->group(function (){
            Route::get('/myrefs', [ReferralController::class, 'index'])->name('myreferrals');
        });
        Route::resource('transactions', TransactionController::class);
        //Route::resource('recyclable-prices', RecyclablePriceController::class);
        Route::resource('recyclables', RecyclableController::class);
    });
});