<?php

use App\Http\Controllers\AgentController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
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

Route::get('/', [HomeController::class, 'getActiveProducts']);
Route::get('/product/{shortname}', [ProductController::class, 'getProductView']);
Route::post('/updatecart', [CartController::class, 'addToCart']);
Route::get('/cart', [CartController::class, 'getCartView']);
Route::post('/delete-from-cart', [ProductController::class, 'deleteFromCart']);
Route::post('/cart-change-quantity', [ProductController::class, 'cartChangeQuantity']);
Route::get('/order', [CartController::class, 'showOrderForm']);
Route::post('/finishOrder', [CartController::class, 'finishOrder']);
Route::any('/login', [LoginController::class, 'login'])->name('login');
Route::get('/logout', [LoginController::class, 'logout']);

// *************** ADMIN ***************

Route::middleware(['auth', 'admin'])->group(function () {
    Route::prefix('admin')->group(function () {

        // *************** GENERAL ***************

        Route::get('/', [ManagerController::class, 'getAdminDashboard']);
        Route::get('/product-management', [ManagerController::class, 'getAllProducts']);
        Route::get('/order-management', [ManagerController::class, 'getAllOrders']);
        Route::get('/agent-management', [ManagerController::class, 'getAllAgents']);
        Route::any("/change-password", [LoginController::class, 'changePassword']);

        // *************** PRODUCT ***************

        Route::post('/product-management/save', [ProductController::class, 'save']);
        Route::post('/product-management/delete', [ProductController::class, 'delete']);
        Route::post('/product-management/search', [ProductController::class, 'search']);
        Route::any("/product-management/add", [ProductController::class, 'add']);
        Route::get("/product-management/edit-thumbnail/{productid}", [ProductController::class, 'getChangeProductThumbnailView']);
        Route::post("/product-management/edit-thumbnail/save", [ProductController::class, 'changeProductThumbnail']);
        Route::get("/product-management/product-colors/{productId}", [ProductController::class, 'getProductColorsView']);
        Route::post("/product-management/product-colors/add", [ProductController::class, 'addColor']);
        Route::post("/product-management/product-colors/delete", [ProductController::class, 'deleteColor']);
        Route::get("/product-management/product-sizes/{productId}", [ProductController::class, 'getProductSizesView']);
        Route::post("/product-management/product-sizes/add", [ProductController::class, 'addSize']);
        Route::post("/product-management/product-sizes/delete", [ProductController::class, 'deleteSize']);

        // *************** ORDER ***************

        Route::post('/order-management/save', [OrderController::class, 'save']);
        Route::post('/order-management/delete', [OrderController::class, 'delete']);
        Route::post('/order-management/search', [OrderController::class, 'search']);
        Route::get("/order-management/order-details/{orderId}", [OrderController::class, 'getOrderDetailsView']);
        Route::post('/order-management/order-details/save', [OrderController::class, 'saveDetail']);
        Route::post('/order-management/order-details/delete', [OrderController::class, 'deleteDetail']);
        Route::get("/new-order", [OrderController::class, 'getNewOrderView']);
        Route::get("/new-order/get-colors/{productId}", [ProductController::class, 'getColors']);
        Route::get("/new-order/get-sizes/{productId}", [ProductController::class, 'getSizes']);
        Route::get("/new-order/get-price/{productId}", [ProductController::class, 'getPrice']);

        // *************** AGENT ***************

        Route::any("/agent-management/add", [AgentController::class, 'add']);
        Route::post('/agent-management/save', [AgentController::class, 'save']);
        Route::post('/agent-management/delete', [AgentController::class, 'delete']);
        Route::post('/agent-management/search', [AgentController::class, 'search']);
    });
});

// *************** AGENT ***************

Route::middleware(['auth', 'agent'])->group(function () {
    Route::prefix('agent')->group(function () {

        // *************** GENERAL ***************

        Route::get('/', [AgentController::class, 'getAgentDashboard']);
        Route::any("/change-password", [LoginController::class, 'changePassword']);
        Route::post("/set-first-password", [LoginController::class, 'setFirstPassword']);

        // *************** ORDER ***************

        Route::post('/order-management/save', [OrderController::class, 'save']);
        Route::post('/order-management/delete', [OrderController::class, 'delete']);
        Route::post('/order-management/search', [OrderController::class, 'search']);
        Route::get("/order-management/order-details/{orderId}", [OrderController::class, 'getOrderDetailsView']);
        Route::post('/order-management/order-details/save', [OrderController::class, 'saveDetail']);
        Route::post('/order-management/order-details/delete', [OrderController::class, 'deleteDetail']);
        Route::get("/new-order", [OrderController::class, 'getNewOrderView']);
        Route::get("/new-order/get-colors/{productId}", [ProductController::class, 'getColors']);
        Route::get("/new-order/get-sizes/{productId}", [ProductController::class, 'getSizes']);
        Route::get("/new-order/get-price/{productId}", [ProductController::class, 'getPrice']);

    });
});
