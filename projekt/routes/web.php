<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Middleware\IsAdmin;


Route::get('/', fn() => view('index'))->name('index');
Route::get('/order-details', fn() => view('order_details'))->name('orderDetails');
Route::get('/product-page', fn() => view('productPage'))->name('productPage');
Route::get('/account', fn() => view('account'))->name('account');

Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

Route::post('/logout', function () {
    auth()->logout();
    return redirect()->route('index');
})->name('logout');

Route::get('/search-filter/{type?}', [ProductController::class, 'searchFilter'])->name('searchFilter');

Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');



Route::post('/shopping-cart', [CartController::class, 'addToCart'])->name('shopping-cart.add');
Route::get('/shopping-cart', [CartController::class, 'showCart'])->name('shoppingCart');
Route::delete('/shopping-cart/{id}', [CartController::class, 'destroy'])->name('shopping-cart.destroy');
Route::post('/shopping-cart/update-quantity', [CartController::class, 'updateQuantity'])->name('shopping-cart.updateQuantity');
Route::get('/reset-cart', function () {
    session()->forget('cart');
    return redirect()->route('shoppingCart')
        ->with('success', 'Cart has been reset.');
})->name('cart.reset');



Route::get('/order', [OrderController::class, 'showOrderForm'])->name('order.form');
Route::post('/order', [OrderController::class, 'placeOrder'])->name('order.submit');


Route::prefix('admin')
    ->middleware(['auth', IsAdmin::class])

    ->group(function(){
        Route::get('/{type?}', [ProductController::class, 'showAdminPage'])->name('adminPage');

        Route::get('/products', [ProductController::class, 'index'])->name('admin.products.index');
        Route::post('/products', [ProductController::class, 'store'])->name('admin.products.store');
        Route::put('/products/{product}', [ProductController::class, 'update'])->name('admin.products.update');
        Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('admin.products.destroy');
    });
