<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;


Route::controller(AuthController::class)
     ->prefix('user')
     ->name('user.')
     ->group(function () {
    Route::post('/login', 'login')->name('login');
    Route::post('/register', 'register')->name('register');
    Route::middleware('auth:sanctum')->post('/logout', 'logout')->name('logout');
});
 



Route::post('user', [UserController::class, 'update'])->name('user.update')->name('user.update')->middleware('auth:sanctum'); 

//Routes for shops
Route::resource('shops', ShopController::class);


//Routes for products
Route::resource('products', ProductController::class);
Route::get('/products/shop/{shop_id}', [ProductController::class,'indexShopProducts'])->name('products.indexShopProducts');
