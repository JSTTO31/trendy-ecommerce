<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Inertia\Inertia;

class OrderController extends Controller
{
    public function index(Request $request){
        $orders = Order::where('user_id', $request->user()->id)->paginate();

        return Inertia::render('Order/Index', [
            'orders' => $orders
        ]);
    }

    public function show(Request $request, Order $order){
        $order->load(['order_items.product']);

        return Inertia::render('Order/Show', [
            'order' => $order
        ]);
    }
}
