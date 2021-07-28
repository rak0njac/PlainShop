<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'show']);

Route::get('/product/{shortname}', [ProductController::class, 'show']);

Route::post('/updatecart', [ProductController::class, 'updateCart']);

Route::get('/cart', [CartController::class, 'show']);

Route::post('/delete-from-cart', [ProductController::class, 'deleteFromCart']);
