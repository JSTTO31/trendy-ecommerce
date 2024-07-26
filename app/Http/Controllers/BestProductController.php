<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BestProductController extends Controller
{
    public function __invoke(Request $request)
    {
        $products = Product::cursorPaginate(20);

        return Inertia::render('BestProduct', [
            'products' => $products,
        ]);
    }
}
