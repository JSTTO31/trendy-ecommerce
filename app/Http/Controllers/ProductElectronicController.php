<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductElectronicController extends Controller
{
    public function __invoke(Request $request)
    {
        $products = Product::where('category', 'LIKE', '%laptops%')->orWhere('category', 'LIKE', '%smartphones%')->orWhere('category', 'LIKE', '%tablets%')->inRandomOrder()->limit(20)->cursorPaginate(20);


        return Inertia::render('Electronics', [
            'products' => $products,
        ]);
    }
}
