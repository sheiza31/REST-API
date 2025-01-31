<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartsController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\CartItemsController;
use App\Http\Controllers\OrderItemsController;

Route::middleware('auth:api')->group(function () {
    Route::resource('carts', CartsController::class);
    Route::resource('cart-items', CartItemsController::class);
    Route::resource('orders', OrdersController::class)->only(['index', 'store', 'show']);
    Route::resource('order-items', OrderItemsController::class)->only(['index', 'store', 'show', 'destroy']);
});



Route::resource('categories', CategoriesController::class);
Route::resource('products', ProductsController::class);



Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);


Route::middleware('auth:api')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('me', [AuthController::class, 'me']);
});




