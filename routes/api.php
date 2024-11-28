<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;


/*
|--------------------------------------------------------------------------
| Routes Handled For Authentication
|--------------------------------------------------------------------------
|
|    POST   |    /user/login     |    login      |    user.login
|    POST   |    /user/register  |    register   |    user.register
|    POST   |    /user/logout    |    logout     |    user.logout
*/
Route::controller(AuthController::class)
     ->prefix('user')
     ->name('user.')
     ->group(function () {
    Route::post('/login', 'login')->name('login');
    Route::post('/register', 'register')->name('register');
    Route::middleware('auth:sanctum')->post('/logout', 'logout')->name('logout');
});
 
/*
|--------------------------------------------------------------------------
| Routes Handled For User
|--------------------------------------------------------------------------
|
|    POST   |    /users    |    update     |    users.update
*/
Route::controller(UserController::class)
     ->prefix('users')
     ->name('users.')
     ->middleware('auth:sanctum')
     ->group(function () {
    Route::post('/', 'update')->name('update');
});

/*
|--------------------------------------------------------------------------
| Routes Handled For Shop
|--------------------------------------------------------------------------
|                |                    |             |
|    GET         |    /shops/index    |    index    |    photos.index
|    POST        |    /shops          |    store    |    photos.store
|    GET         |    /shops/{shop}   |    show     |    photos.show
|    PUT|PATCH   |    /shops/{shop}   |    update   |	 photos.update
|    DELETE      |    /shops/{shop}   |    destroy  |    photos.destroy
*/
Route::apiResource('shops', ShopController::class);

/*
|--------------------------------------------------------------------------
| Routes Handled For Product
|--------------------------------------------------------------------------
|               |                          |             |
|   GET         |    /products/index       |    index    |    photos.index
|   POST        |    /products             |    store    |    photos.store
|   GET         |    /products/{product}   |    show     |    photos.show
|   PUT|PATCH   |    /products/{product}   |    update   |	  photos.update
|   DELETE      |    /products/{product}   |    destroy  |    photos.destroy
|   GET         |    /products/shop/{shop_id} | indexShopProducts | products.indexShopProducts
*/
Route::apiResource('products', ProductController::class);
Route::get('/products/shop/{shop_id}', [ProductController::class,'indexShopProducts'])->name('products.indexShopProducts');
