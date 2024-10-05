<?php

use App\Http\Controllers\Api\DataController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

// Route::get('/products/data-big', [DataController::class, 'productsBig'])->name('products.databig'); // DataTableBig
// Route::get('/products/data-small', [DataController::class, 'productsSmall'])->name('products.datasmall'); // DataTableSmall
Route::get('/products/api/{id?}', [DataController::class, 'index'])->name('products.api'); // dashboard

// Route::get('/', [HomeController::class, 'index'])->name('dashboard');
// Route::resource('products', ProductController::class);
// Route::resource('shops', ShopController::class);
// Route::resource('transactions', TransactionController::class);

// Route::get('/jarak', [HomeController::class, 'jarak'])->name('jarak');
// Route::resource('products', PlaceController::class);
// Route::resource('shops', PlaceController::class);
// Route::resource('transactions', PlaceController::class);

Route::group(['middleware' => ['auth']], function () {
    Route::get('/', [HomeController::class, 'index'])->name('dashboard');
    // Route::get('/jarak', [mapController::class, 'jarak'])->name('jarak');
    Route::resource('products', ProductController::class);
    Route::resource('shops', ShopController::class);
    Route::resource('transactions', TransactionController::class);
});

