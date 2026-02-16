<?php

use App\Http\Controllers\ShopController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

// Shop Routes
Route::get('/', [ShopController::class, 'home'])->name('home');
Route::get('/boutique', [ShopController::class, 'index'])->name('shop');
Route::post('/boutique/recherche-image', [ShopController::class, 'searchByImage'])->name('shop.search-by-image');
Route::get('/produit/{slug}', [ShopController::class, 'show'])->name('product.show');
Route::get('/panier', [ShopController::class, 'cart'])->name('cart');
Route::get('/commander', [ShopController::class, 'checkout'])->name('checkout');
Route::get('/commande/{numero}/succes', [ShopController::class, 'orderSuccess'])->name('order.success');

// Auth Routes (Breeze)
Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
