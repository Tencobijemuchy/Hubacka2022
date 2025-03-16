<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;

Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('/shopping-cart', function () {
    return view('ShoppingCart');
})->name('shoppingCart');

Route::get('/search-filter', function () {
    return view('searchFilter');
})->name('searchFilter');

Route::get('/admin-page', function () {
    return view('adminPage');
})->name('adminPage');

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


// Používame kontroléry pre registráciu a prihlasovanie:
Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
