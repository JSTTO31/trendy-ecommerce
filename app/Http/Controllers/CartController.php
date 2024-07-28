<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class CartController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('Cart/Index');
    }

    public function store(Request $request, Product $product){
        $request->validate([
            'quantity' => ['required', 'min:1'],
        ]);

        $priceWithDiscount = $product->price - ($product->discountPercentage / $product->price);

        $order_item = $request->user()->carts()->updateOrCreate(['product_id' => $product->id], [
            'price' => (int)$request->quantity * $priceWithDiscount,
            'quantity' => $request->quantity,
        ]);

        if($order_item->wasRecentlyCreated){
            return Redirect::back()->with('information', 'Product Added to Cart!');
        }else{
            return Redirect::back()->with('information', 'Cart Updated Successfully!');
        }
    }

    public function update(Request $request,  Product $product, OrderItem $orderItem){
        $request->validate([
            'quantity' => ['required', 'min:1'],
        ]);

        $priceWithDiscount = $product->price - ($product->discountPercentage / $product->price);

        $orderItem->update([
            'price' => (int)$request->quantity * $priceWithDiscount,
            'quantity' => $request->quantity,
        ]);

        return Redirect::back()->with('information', 'Cart Updated Successfully!');
    }

    public function destroy(Request $request, Product $product, OrderItem $orderItem){
        $orderItem->delete();

        return Redirect::back()->with('information', 'Cart item successfully removed!');
    }

}
