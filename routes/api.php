<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseTransactionDetailController;
use App\Http\Controllers\PurchaseTransactionHeaderController;
use App\Http\Controllers\SaleTransactionDetailController;
use App\Http\Controllers\SaleTransactionHeaderController;
use App\Http\Controllers\UserController;
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

Route::middleware('auth:api')->group(function () {
    Route::get('/users/me', [UserController::class, 'me'])
        ->name('users.me');

    Route::apiResources([
        'users' => UserController::class,
        'products' => ProductController::class,
    ]);

    Route::apiResource('purchase-transactions', PurchaseTransactionHeaderController::class)
        ->except(['update']);

    Route::apiResource('purchase-transactions.details', PurchaseTransactionDetailController::class)
        ->only(['index', 'show']);

    Route::apiResource('sale-transactions', SaleTransactionHeaderController::class)
        ->except(['update']);

    Route::apiResource('sale-transactions.details', SaleTransactionDetailController::class)
        ->only(['index', 'show']);
});
