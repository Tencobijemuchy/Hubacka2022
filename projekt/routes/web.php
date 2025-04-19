<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;

Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('/order-details', function () {
    return view('order_details');
})->name('orderDetails');



Route::get('/product-page', function () {
    return view('productPage');
})->name('productPage');

Route::get('/account', function () {
    return view('account');
})->name('account');


Route::post('/logout', function () {
    auth()->logout();
    return redirect()->route('index');
})->name('logout');



Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

Route::post('/admin/products', [ProductController::class, 'store'])->name('admin.products.store');
Route::get('/search-filter/{type?}', [ProductController::class, 'searchFilter'])->name('searchFilter');

Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

Route::get('/admin-page{type?}', [ProductController::class, 'showAdminPage'])->name('adminPage');

Route::get('/admin/products', [ProductController::class, 'index'])->name('admin.products.index');

Route::delete('/admin/products/{id}', [ProductController::class, 'destroy'])->name('admin.products.destroy');

Route::put('/admin/products/{product}', [ProductController::class, 'update'])->name('admin.products.update');



Route::post('/shopping-cart', [CartController::class, 'addToCart'])->name('shopping-cart.add');

Route::get('/shopping-cart', [CartController::class, 'showCart'])->name('shoppingCart');

Route::delete('/shopping-cart/{id}', [CartController::class, 'destroy'])->name('shopping-cart.destroy');

Route::post('/shopping-cart/update-quantity', [CartController::class, 'updateQuantity'])->name('shopping-cart.updateQuantity');

Route::get('/order', [OrderController::class, 'showOrderForm'])->name('order.form');

Route::post('/order', [OrderController::class, 'placeOrder'])->name('order.submit');


Route::get('/reset-cart', function () {
    session()->forget('cart');
    return redirect()->route('shoppingCart')->with('success', 'Cart has been reset.');
});

?>