<?php

use App\Http\Controllers\AgentController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderDetailController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductDetailController;
use App\Http\Controllers\UserOrderController;
use App\Http\Controllers\UserProductController;
use App\Models\OrderDetail;
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

// *************** GENERAL ***************

Route::get('/', [UserProductController::class, 'list']);
Route::get('/product/{shortname}', [UserProductController::class, 'show']);
Route::post('/search', [UserProductController::class, 'find']);
Route::post('/update-cart', [CartController::class, 'update']);
Route::get('/cart', [CartController::class, 'index']);
Route::post('/delete-from-cart', [CartController::class, 'deleteDetail']);
Route::post('/cart-change-quantity', [CartController::class, 'changeDetailQuantity']);
Route::get('/order', [UserOrderController::class, 'new']);
Route::post('/finish-order', [UserOrderController::class, 'new']);
Route::get('/show-order-confirmation', [UserOrderController::class, 'showConfirmation']);
Route::any('/login', [LoginController::class, 'login'])->name('login');
Route::get('/logout', [LoginController::class, 'logout']);

// *************** ADMIN ***************

Route::middleware(['auth', 'admin'])->group(function () {
    Route::prefix('admin')->group(function () {

        // *************** GENERAL ***************

        Route::get('/', [ManagerController::class, 'index']);
        Route::get('/product-management', [ProductController::class, 'list']);
        Route::get('/order-management', [OrderController::class, 'list']);
        Route::get('/agent-management', [AgentController::class, 'list']);
        Route::any("/change-password", [LoginController::class, 'changePassword']);

        // *************** PRODUCT ***************

        Route::post('/product-management/save', [ProductController::class, 'update']);
        Route::post('/product-management/delete', [ProductController::class, 'delete']);
        Route::post('/product-management/search', [ProductController::class, 'find']);
        Route::any("/product-management/add", [ProductController::class, 'new']);
        Route::get("/product-management/edit-thumbnail/{productid}", [ProductController::class, 'changeThumbnail']);
        Route::post("/product-management/edit-thumbnail/save", [ProductDetailController::class, 'changeThumbnail']);
        Route::get("/product-management/product-colors/{productId}", [ProductDetailController::class, 'showColors']);
        Route::post("/product-management/product-colors/add", [ProductDetailController::class, 'newColor']);
        Route::post("/product-management/product-colors/delete", [ProductDetailController::class, 'deleteColor']);
        Route::get("/product-management/product-sizes/{productId}", [ProductDetailController::class, 'showSizes']);
        Route::post("/product-management/product-sizes/add", [ProductDetailController::class, 'newSize']);
        Route::post("/product-management/product-sizes/delete", [ProductDetailController::class, 'deleteSize']);

        // *************** ORDER ***************

        Route::post('/order-management/save', [OrderController::class, 'update']);
        Route::post('/order-management/delete', [OrderController::class, 'delete']);
        Route::post('/order-management/search', [OrderController::class, 'find']);
        Route::get("/order-management/order-details/{orderId}", [OrderDetailController::class, 'list']);
        Route::post('/order-management/order-details/save', [OrderDetailController::class, 'update']);
        Route::post('/order-management/order-details/delete', [OrderDetailController::class, 'delete']);
        Route::get("/new-order", [OrderController::class, 'new']);
        Route::get("/new-order/get-product-details/{productId}", [ProductDetailController::class, 'getDetails']);

        // *************** AGENT ***************

        Route::any("/agent-management/add", [AgentController::class, 'new']);
        Route::post('/agent-management/save', [AgentController::class, 'update']);
        Route::post('/agent-management/delete', [AgentController::class, 'delete']);
        Route::post('/agent-management/search', [AgentController::class, 'find']);
    });
});

// *************** AGENT ***************

Route::middleware(['auth', 'agent'])->group(function () {
    Route::prefix('agent')->group(function () {

        // *************** GENERAL ***************

        Route::get('/', [AgentController::class, 'index']);
        Route::get("/new-order", [OrderController::class, 'new']);
        Route::get('/order-management', [OrderController::class, 'list']);
        Route::any("/change-password", [LoginController::class, 'changePassword']);
        Route::post("/set-first-password", [LoginController::class, 'setFirstPassword']);

        // *************** ORDER ***************

        Route::post('/order-management/save', [OrderController::class, 'update']);
        Route::post('/order-management/delete', [OrderController::class, 'delete']);
        Route::post('/order-management/search', [OrderController::class, 'find']);
        Route::get("/order-management/order-details/{orderId}", [OrderDetailController::class, 'list']);
        Route::post('/order-management/order-details/save', [OrderDetailController::class, 'update']);
        Route::post('/order-management/order-details/delete', [OrderDetailController::class, 'delete']);
        Route::get("/new-order/get-product-details/{productId}", [ProductDetailController::class, 'getDetails']);
    });
});
