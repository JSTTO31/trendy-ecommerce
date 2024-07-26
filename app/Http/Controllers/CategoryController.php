<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CategoryController extends Controller
{
    public function index(Request $request){
        $categories = Category::all();

        $categories = collect($categories)->map(fn($item) => [
            'id' => $item['id'],
            'name' => $item['name'],
            'color' => $item['color'],
            'image' => asset($item['image']),
        ]);

        return Inertia::render('Category/Index', [
            'categories' => $categories,
        ]);
    }

    public function show(Request $request, Category $category)
    {
        $products = Product::where('category', 'like', '%' . $category->name . '%')->cursorPaginate(20);

        return Inertia::render('Category/Show', [
            'category' => $category,
            'products' => $products,
        ]);
    }

}
