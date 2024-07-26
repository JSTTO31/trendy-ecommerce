<?php

use App\Http\Controllers\BestProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductElectronicController;
use App\Http\Controllers\ProfileController;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    $products = Product::limit(4)->get();
    $categories = Category::skip(2)->limit(12)->get();
    $categories = collect($categories)->map(fn($item) => [
        'id' => $item['id'],
        'name' => $item['name'],
        'color' => $item['color'],
        'image' => asset($item['image']),
    ]);
    $gadgets = Product::where('category', 'LIKE', '%laptops%')->orWhere('category', 'LIKE', '%smartphones%')->orWhere('category', 'LIKE', '%tablets%')->inRandomOrder()->limit(4)->get();
    $essentials = Product::where('category', 'LIKE', '%groceries%')->inRandomOrder()->limit(6)->get();

    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
        'hero_images' => [
            asset('hero/1.jpg'),
            asset('hero/2.jpg'),
            asset('hero/3.jpg'),
        ],
        'categories' => $categories,
        'products' => $products,
        'gadgets' => $gadgets,
        'essentials' => $essentials,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/best-products', BestProductController::class)->name('best-products');
Route::get('/electronic-products', ProductElectronicController::class)->name('electronic-products');
Route::get('/products/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/products/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
