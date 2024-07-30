<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CheckoutController extends Controller
{

    public function index(){
        return Inertia::render('Checkout/Index');
    }

    public function checkout(Request $request){
        $order = $request->user()->orders()->create();
        $order_items = OrderItem::with('product')->where('order_id', null)->get();
        $line_items = [];
        $total = 0;

        OrderItem::where('order_id', null)->update([
            'order_id' => $order->id,
        ]);

        foreach($order_items as $order_item){
            array_push($line_items, [
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => $order_item->product->title,
                        'images' => $order_item->product->images,
                    ],
                    'unit_amount' => round(($order_item->product->price - ($order_item->product->discountPercentage / $order_item->product->price)) * 100),
                ],
                'quantity' => $order_item->quantity,
            ]);

            $total += $order_item->price;
        }

        $apiKey = env('STRIPE_SECRET');
        $stripe = new \Stripe\StripeClient([
            "api_key" => $apiKey,
        ]);

        $checkout_session = $stripe->checkout->sessions->create([
            'line_items' => $line_items,
            'mode' => 'payment',
            'ui_mode' => 'embedded',
            'return_url' => route('checkout.success') . '?session_id={CHECKOUT_SESSION_ID}',
        ]);

        $client_secret = $checkout_session->client_secret;

        $order->session_id = $checkout_session->id;
        $order->status = 'unpaid';
        $order->total = $total;
        $order->save();

        return [
            'clientSecret' => $client_secret
        ];
    }

    public function success(Request $request){
        try {
            $apiKey = env('STRIPE_SECRET');
            $stripe = new \Stripe\StripeClient([
                "api_key" => $apiKey,
            ]);

            $session = $stripe->checkout->sessions->retrieve($request->session_id);

            $order = Order::where('session_id', $request->session_id)->first();

            if(!$order){
                throw new NotFoundHttpException();
            }

            $order->status = $session->status;
            $order->save();

            return Inertia::render('Checkout/Success', [
                'image' => asset('icons/shopping-basket.png')
            ]);
        } catch (\Exception $e) {
            throw new NotFoundHttpException();
        }
    }

    public function cancel(){
        return Inertia::render('Checkout/Cancel');
    }
}
