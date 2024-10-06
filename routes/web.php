<?php

use App\Http\Controllers\Api\DataController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::get('/', [HomeController::class, 'index'])->name('dashboard');
    // Route::get('/jarak', [mapController::class, 'jarak'])->name('jarak');
    Route::resource('products', ProductController::class);
    Route::resource('shops', ShopController::class);
    Route::resource('transactions', TransactionController::class);


    // 2 tipe meawikili tiap button
    Route::get('data/product-big', [DataController::class, 'productsBig'])->name('data.product-big');
    Route::get('data/product-small', [DataController::class, 'productsSmall'])->name('data.product-small');

    Route::get('data/shop-big', [DataController::class, 'shopsBig'])->name('data.shop-big');
    Route::get('data/shop-small', [DataController::class, 'shopsSmall'])->name('data.shop-small');

    Route::get('data/transaction-big', [DataController::class, 'transactionsBig'])->name('data.transaction-big');
    Route::get('data/transaction-small', [DataController::class, 'transactionsSmall'])->name('data.transaction-small');
});