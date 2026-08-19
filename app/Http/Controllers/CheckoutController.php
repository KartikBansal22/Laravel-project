<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class CheckoutController extends Controller
{
  
    public function index()
    {
        $cart = Cart::with('items.product')->where('user_id', Auth::id())->firstOrFail();

        if ($cart->items->isEmpty()) {
            return redirect()->route('cart.index')->withErrors(['cart' => 'Your cart is empty.']);
        }

        return view('checkout.index', compact('cart'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'shipping_address' => ['required', 'string', 'max:500'],
        ]);

        $userId = Auth::id();

        try {
            $order = DB::transaction(function () use ($userId, $validated) {

                $cart = Cart::with('items')->where('user_id', $userId)->firstOrFail();

                if ($cart->items->isEmpty()) {
                    throw ValidationException::withMessages(['cart' => 'Your cart is empty.']);
                }

                $order = Order::create([
                    'user_id'          => $userId,
                    'status'           => Order::STATUS_PENDING,
                    'total_amount'     => 0,
                    'shipping_address' => $validated['shipping_address'],
                ]);

                $total = 0;

                foreach ($cart->items as $cartItem) {

                 
                    $product = Product::where('id', $cartItem->product_id)
                        ->lockForUpdate()
                        ->firstOrFail();

                    if ($cartItem->quantity > $product->stock_quantity) {
                        throw ValidationException::withMessages([
                            'stock' => "Sorry, only {$product->stock_quantity} of \"{$product->name}\" left in stock. Please update your cart.",
                        ]);
                    }

                    $order->items()->create([
                        'product_id' => $product->id,
                        'quantity'   => $cartItem->quantity,
                        'unit_price' => $product->price,
                    ]);

                    $product->decrement('stock_quantity', $cartItem->quantity);

                    $total += $cartItem->quantity * $product->price;
                }

                $order->update(['total_amount' => $total]);

               
                $cart->items()->delete();

                return $order;
            });

        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        }

        return redirect()->route('orders.show', $order->id)->with('success', 'Order placed successfully!');
    }
}