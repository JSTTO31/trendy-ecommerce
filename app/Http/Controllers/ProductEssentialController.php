<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductEssentialController extends Controller
{
    public function __invoke(Request $request)
    {
        $products = Product::where('category', 'LIKE', '%groceries%')->inRandomOrder()->cursorPaginate(20);


        return Inertia::render('Essentials', [
            'products' => $products,
        ]);
    }
}
