<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;


/*
|-------------------------------------------------------------------------------
| Routes Handled For Authentication
|-------------------------------------------------------------------------------
|          |                    |               |          
|   POST   |    /auth/login     |    login      |    auth.login
|   POST   |    /auth/register  |    register   |    auth.register
|   POST   |    /auth/logout    |    logout     |    auth.logout
*/
Route::controller(AuthController::class)
     ->prefix('auth')
     ->name('auth.')
     ->group(function () {
    Route::post('/login', 'login')->name('login');
    Route::post('/register', 'register')->name('register');
    Route::middleware('auth:sanctum')->post('/logout', 'logout')->name('logout');
});
 
/*
|-------------------------------------------------------------------------------
| Routes Handled For User
|-------------------------------------------------------------------------------
|          |                            |            |                 
|   POST   |   /users                   |   update   |   users.update
|   GET    |   /users/{user_id}/orders  |   orders   |   users.orders
*/
Route::controller(UserController::class)
     ->prefix('users')
     ->name('users.')
     ->middleware('auth:sanctum')
     ->group(function () {
    Route::post('/', 'update')->name('update');
    Route::get('/{user_id}/orders', 'orders')->name('orders');
});

/*
|-------------------------------------------------------------------------------
| Routes Handled For Shop
|-------------------------------------------------------------------------------
|              |                              |              |
|   GET        |   /shops/index               |    index     |    shops.index
|   POST       |   /shops                     |    store     |    shops.store
|   GET        |   /shops/{shop}              |    show      |    shops.show
|   PUT|PATCH  |   /shops/{shop}              |    update    |	  shops.update
|   DELETE     |   /shops/{shop}              |    destroy   |    shops.destroy
|   GET        |   /shops/{shop_id}/products  |    products  |    shops.products
*/
Route::apiResource('shops', ShopController::class);
Route::get('/shops/{shop_id}/products', [ShopController::class,'products'])->name('shops.products');

/*
|-------------------------------------------------------------------------------
| Routes Handled For Product
|-------------------------------------------------------------------------------
|              |                          |             |
|   GET        |    /products/index       |    index    |    products.index
|   POST       |    /products             |    store    |    products.store
|   GET        |    /products/{product}   |    show     |    products.show
|   PUT|PATCH  |    /products/{product}   |    update   |	 products.update
|   DELETE     |    /products/{product}   |    destroy  |    products.destroy
*/
Route::apiResource('products', ProductController::class);

/*
|-------------------------------------------------------------------------------
| Routes Handled For Order
|-------------------------------------------------------------------------------
|              |                      |             |
|   GET        |    /orders/index     |    index    |    orders.index
|   POST       |    /orders           |    store    |    orders.store
|   GET        |    /orders/{order}   |    show     |    orders.show
|   PUT|PATCH  |    /orders/{order}   |    update   |	 orders.update
|   DELETE     |    /orders/{order}   |    destroy  |    orders.destroy
*/
Route::controller(OrderController::class)
     ->prefix('orders')
     ->name('orders.')
     ->group(function () {

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/', 'store')->name('store');
        Route::get('/index', 'index')->name('index');
        Route::get('/{order}', 'show')->name('show');
        Route::put('/{order}', 'update')->name('update');
        Route::patch('/{order}', 'update')->name('update');
        Route::delete('/{order}', 'destroy')->name('destroy');
    });

});
