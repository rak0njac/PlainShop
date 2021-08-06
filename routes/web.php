<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
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

Route::post('/cart-change-quantity', [ProductController::class, 'cartChangeQuantity']);

Route::get('/order', [CartController::class, 'showOrderForm']);

Route::post('/finishOrder', [CartController::class, 'finishOrder']);

Route::get('/admin', function (){
    return view('manager');
})->middleware('auth');

Route::get('/login', [LoginController::class, 'show'])->name('login');

Route::post('/login', [LoginController::class, 'login']);

Route::get('/logout', [LoginController::class, 'logout']);
