<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function index(){

    }

    public function show(Request $request, Product $product){

        $reviews = Review::with(['user'])
                   ->when($request->rating, fn($query) => $query->where('rating', $request->rating))
                   ->where('product_id', $product->id)
                   ->when($request->sortBy == 'oldest', fn($query) => $query->orderBy('created_at', 'ASC'), fn($query) => $query->latest())
                   ->paginate(5);

        $star_counts = Review::where('product_id', $product->id)->select(DB::raw('COUNT(rating) as count, rating'))->groupBy('rating')->orderByDesc('rating')->get();

        return Inertia::render('Product/Show', [
            'product' => $product,
            'reviews' => $reviews,
            'star_counts' => $star_counts,
            'review_counts' => collect($star_counts)->reduce(fn($carry, $item) => $carry + $item['count'], 0),
            'query' => $request->query(),
        ]);
    }
}
