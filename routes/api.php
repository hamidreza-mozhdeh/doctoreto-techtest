<?php

use App\Http\Controllers\DiscountCodeController;
use App\Http\Controllers\DiscountHistoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WalletController;
use Illuminate\Support\Facades\Route;

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
Route::apiResource('discount_codes', DiscountCodeController::class)
    ->only(['show', 'index', 'store']);

Route::apiResource('users', UserController::class)
    ->only(['show', 'index', 'store']);

Route::post('wallets', [WalletController::class, 'deposit'])
    ->name('wallets.deposit');

Route::post('discount_histories', [DiscountHistoryController::class, 'useDiscount'])
    ->name('discount_histories.use_discount');


