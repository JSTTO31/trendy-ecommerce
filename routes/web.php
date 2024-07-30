<?php

use App\Http\Controllers\BestProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductElectronicController;
use App\Http\Controllers\ProductEssentialController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', WelcomeController::class);

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('home');

Route::get('/best-products', BestProductController::class)->name('best-products');
Route::get('/electronic-products', ProductElectronicController::class)->name('electronic-products');
Route::get('/essential-products', ProductEssentialController::class)->name('essential-products');
Route::get('/products/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/products/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');


Route::controller(OrderController::class)->middleware('auth')->group(function(){
    Route::get('/orders', 'index')->name('orders.index');
    Route::get('/orders/{order}', 'show')->name('orders.show');
});

Route::controller(ProductController::class)->group(function(){
    Route::get('/products', 'index')->name('products.index');
    Route::get('/products/{product}', 'show')->name('products.show');
});

Route::controller(CartController::class)->prefix('cart/items')->middleware(['auth'])->group(function(){
    Route::get('', 'index')->name('carts.index');
    Route::post('/{product}', 'store')->name('carts.store');
    Route::put('/{product}/item/{orderItem}', 'update')->name('carts.update');
    Route::delete('/{product}/item/{orderItem}', 'destroy')->name('carts.destroy');
});

Route::controller(CheckoutController::class)->middleware(['auth'])->group(function(){
    Route::get('/checkout', 'index')->name('checkout.index');
    Route::post('/checkout', 'checkout')->name('checkout.create');
    Route::get('/checkout/success', 'success')->name('checkout.success');
    Route::get('/checkout/cancel', 'cancel')->name('checkout.cancel');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
