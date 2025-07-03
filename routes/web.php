<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController; // <-- TAMBAHKAN IMPORT INI
use App\Http\Controllers\CartController; 
use App\Models\Product;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Route untuk halaman publik
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/store', [PageController::class, 'store'])->name('store');
Route::get('/faq', [PageController::class, 'faq'])->name('faq');

// Route untuk proses checkout
Route::get('/checkout', [PageController::class, 'checkout'])->name('checkout');
Route::post('/receipt', [PageController::class, 'generateReceipt'])->name('receipt.generate');

// Route untuk halaman yang memerlukan login
Route::middleware(['auth', 'verified'])->group(function () {
    // Route untuk dashboard
    Route::get('/dashboard', [PageController::class, 'dashboard'])->name('dashboard');

    // TAMBAHKAN GRUP ROUTE PROFIL DI SINI
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');

Route::post('/receipt', [PageController::class, 'generateReceipt'])->name('receipt.generate');
// TAMBAHKAN RUTE BARU DI BAWAH INI
Route::get('/receipt/{order}/download', [PageController::class, 'downloadReceipt'])->name('receipt.download');
require __DIR__.'/auth.php';
// Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
// RUTE UNTUK KERANJANG BELANJA
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
Route::patch('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');