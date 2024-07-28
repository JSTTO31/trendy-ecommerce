<?php

namespace App\Http\Middleware;

use App\Models\OrderItem;
use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): string|null
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        $cart_items = OrderItem::with(['product'])->where('user_id', $request->user()->id ?? null)->where('order_id', null)->paginate(5);

        return [
            ...parent::share($request),
            'auth' => [
                'user' => $request->user(),
            ],
            'flash' => [
                'success' => session('success'),
                'information' => session('information')
            ],
            'isAuthenticated' => auth()->check(),
            'cart_items_count' => $cart_items->total(),
            'cart_items' => $cart_items,
        ];
    }
}
