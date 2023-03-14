<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Api\AccessTokensController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\ProfileController;
 use App\Http\Controllers\ProductController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('categories',CategoryController::class)->middleware('auth:web-api');
// Route::apiResource('products',ProductController::class)->middleware('auth:web-api');




    Route::post('auth/access-tokens', [AccessTokensController::class, 'login']);
    Route::post('auth/register', [AccessTokensController::class, 'register']);
    Route::post('auth/password/forgot', [AccessTokensController::class, 'forgotPassword']);
    Route::post('auth/password/reset', [AccessTokensController::class, 'resetPassword']);



    Route::post('auth/home', [HomeController::class, 'home']);
    Route::post('auth/search', [HomeController::class, 'search']);
    Route::post('auth/products', [HomeController::class, 'products']);
    Route::post('auth/product', [HomeController::class, 'product']);
    Route::post('auth/product_items', [HomeController::class, 'product_items']);
    Route::post('auth/product_item', [HomeController::class, 'product_item']);
    Route::post('auth/add_to_cart', [HomeController::class, 'add_to_cart']);
    Route::post('auth/cart', [HomeController::class, 'cart']);
    Route::post('auth/increase_quantity', [HomeController::class, 'increase_quantity']);
    Route::post('auth/lower_quantity', [HomeController::class, 'lower_quantity']);
    Route::delete('auth/delete_product_from_cart', [HomeController::class, 'delete_product_from_cart']);
    Route::delete('auth/delete_cart', [HomeController::class, 'delete_cart']);

    Route::post('auth/add_location', [HomeController::class, 'add_location']);
    Route::post('auth/show_invoice', [HomeController::class, 'show_invoice']);
    Route::post('auth/confirm_order', [HomeController::class, 'confirm_order']);
    Route::post('auth/orders', [HomeController::class, 'orders']);
    Route::post('auth/filter_orders', [HomeController::class, 'filter_orders']);
    Route::post('auth/show_order', [HomeController::class, 'show_order']);

    Route::post('auth/add_fav', [HomeController::class, 'add_fav']);
    Route::post('auth/show_fav', [HomeController::class, 'show_fav']);


    Route::post('auth/edit', [ProfileController::class, 'edit']);
    Route::post('auth/update', [ProfileController::class, 'update']);




    
    // ->middleware('guest:sanctum');

Route::delete('auth/logout', [AccessTokensController::class, 'logout'])->middleware('auth:web-api');
Route::put('auth/changePassword', [AccessTokensController::class, 'changePassword'])->middleware('auth:web-api');
    // ->middleware('auth:sanctum');

// Route::put('deliveries/{delivery}', [DeliveriesController::class, 'update']);
// Route::get('deliveries/{delivery}', [DeliveriesController::class, 'show']);
