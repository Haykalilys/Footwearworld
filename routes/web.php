<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardColntroller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;

Route::post('/registrasi/submit', [AuthController::class, 'submitRegistrasi'])->name('registrasi.submit');

Route::get('/logout', [AuthController::class, 'logout']);

Route::group(['middleware' => ['auth', 'check_role:admin']], function(){
    Route::get('/dashboard', [DashboardColntroller::class, 'index']);
});

Route::group(['middleware' => ['auth', 'check_role:customer']], function(){
    Route::get('/', fn() => 'halaman customer');
});

Route::get('/login', fn() => view('auth.login'))->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', fn() => view('auth.register'))->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/', function () {
    return view('home');
});

Route::get('/collection', function () {
    return view('collection');
});

Route::get('/contact', fn() => view('contact'))->name('contact');
Route::post('/contact', [ContactController::class, 'contact']);

Route::get('/cart', function () {
    return view('cart');
});

Route::get('/product', function () {
    return view('product');
});

Route::get('/checkout', function () {
    return view('checkout');
});
