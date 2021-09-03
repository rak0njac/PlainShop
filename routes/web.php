<?php

use App\Http\Controllers\AgentController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\OrderController;
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

Route::get('/', [HomeController::class, 'getActiveProducts']);

Route::get('/product/{shortname}', [ProductController::class, 'getProductView']);

Route::post('/updatecart', [CartController::class, 'addToCart']);

Route::get('/cart', [CartController::class, 'getCartView']);

Route::post('/delete-from-cart', [ProductController::class, 'deleteFromCart']);

Route::post('/cart-change-quantity', [ProductController::class, 'cartChangeQuantity']);

Route::get('/order', [CartController::class, 'showOrderForm']);

Route::post('/finishOrder', [CartController::class, 'finishOrder']);

Route::get('/admin', function (){
    return view('manager');
})->middleware('auth');

Route::get('/login', [LoginController::class, 'login'])->name('login');

Route::post('/login', [LoginController::class, 'login']);

Route::get('/logout', [LoginController::class, 'logout']);

Route::get('/product-management', [ManagerController::class, 'getAllProducts']);

Route::get('/order-management', [ManagerController::class, 'getAllOrders']);

Route::get('/agent-management', [ManagerController::class, 'getAllAgents']);

Route::get("/product-management/edit-thumbnail/{productid}", [ProductController::class, 'getChangeProductThumbnailView']);

Route::post("/product-management/edit-thumbnail/save", [ProductController::class, 'changeProductThumbnail']);

Route::post('/product-management/save', [ProductController::class, 'save']);
