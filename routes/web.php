<?php

use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

//Protected routes for products and cart START
Route::get('/products', function () {
    return view('products');
})->name('products')->middleware('auth');

Route::get('/cart', function () {
    return view('cart');
})->name('cart')->middleware('auth');

//Products and Cart routes END

require __DIR__.'/auth.php';