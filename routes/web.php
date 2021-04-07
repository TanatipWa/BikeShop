<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;

use App\Http\Controllers\CategoryController;

use App\Http\Controllers\HomeController;

use App\Http\Controllers\CartController;
use App\Http\Middleware\CartMiddleware;

use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    return view('layouts.master');
});

Route::get('/product', [ProductController::class, 'index']);

Route::get('/category', [CategoryController::class, 'index']);

Route::post('/product/search', [ProductController::class, 'search']);

Route::get('/product/edit/{id?}', [ProductController::class, 'edit']);

Route::post('/product/update', [ProductController::class, 'update']);

Route::post('/product/add', [ProductController::class, 'insert']);

Route::get('/product/remove/{id}', [ProductController::class, 'remove']);

Route::get('/home', [HomeController::class, 'index']);

Route::get('/cart/view', [CartController::class, 'viewCart']);

Route::get('/cart/add/{id}', [CartController::class, 'addToCart']);

Route::get('/cart/delete/{id}', [CartController::class, 'deleteCart']);

Route::middleware([CartMiddleware::class])->group(function(){
    Route::get('/cart/update/{id}/{qty}', [CartController::class, 'updateCart']);
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/cart/checkout', [CartController::class, 'checkout']);

Route::get('/cart/complete', [CartController::class, 'complete']);

Route::get('/cart/finish', [CartController::class, 'finish_order']);
