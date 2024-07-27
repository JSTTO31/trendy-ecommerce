<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

class WelcomeController extends Controller
{
    public function __invoke()
    {
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
    }
}
