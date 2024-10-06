<?php

use App\Http\Controllers\Api\DataController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// route untuk semua auth
Auth::routes();

// DIBAWAH INI MERUPAKAN KUMPULAN API
Route::controller(DataController::class)->group(function () {
    // Digunakan Axios untuk mengambil data lokasis toko yang punya produk id
    Route::get('/data/search-loc/{id}', 'index')->name('data.search-loc');
    
    // datatable of products and 2 button type for witdh screen   
    Route::get('/data/product-big', 'productsBig')->name('data.product-big');
    Route::get('/data/product-small', 'productsSmall')->name('data.product-small');
    
    // datatable of shops and 2 button type for witdh screen   
    Route::get('/data/shop-big', 'shopsBig')->name('data.shop-big');
    Route::get('/data/shop-small', 'shopsSmall')->name('data.shop-small');
    
    // datatable of transactions and 2 button type for witdh screen   
    Route::get('/data/transaction-big', 'transactionsBig')->name('data.transaction-big');
    Route::get('/data/transaction-small', 'transactionsSmall')->name('data.transaction-small');
});

Route::group(['middleware' => ['auth']], function () {
    Route::get('/', [HomeController::class, 'index'])->name('dashboard');
    Route::resource('products', ProductController::class)->except('show');
    Route::resource('shops', ShopController::class)->except('show');
    Route::resource('transactions', TransactionController::class)->except('show', 'edit', 'update');
});