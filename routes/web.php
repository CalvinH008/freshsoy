<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{id}', [ProductController::class, 'show'])->middleware('auth');

// Route cart
Route::get('cart', [CartController::class, 'index'])->name('cart.index')->middleware('auth');
Route::post('cart/add/{id}', [CartController::class, 'add'])->name('cart.add')->middleware('auth');
Route::patch('cart/update/{id}', [CartController::class, 'update'])->name('cart.update')->middleware('auth');
Route::delete('cart/destroy/{id}', [CartController::class, 'destroy'])->name('cart.destroy')->middleware('auth');

// Route checkout
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index')->middleware('auth');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store')->middleware('auth');
Route::get('/checkout/success/{orderId}', [CheckoutController::class, 'success'])->name('checkout.success')->middleware('auth');
require __DIR__ . '/auth.php';
