<?php

use App\Http\Controllers\Api\DataController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('data/product-big', [DataController::class, 'productsBig'])->name('data.product-big');
Route::get('data/product-small', [DataController::class, 'productsSmall'])->name('data.product-small');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
