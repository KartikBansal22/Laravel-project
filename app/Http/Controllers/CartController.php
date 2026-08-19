<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Show the logged-in user's cart
    public function index()
    {
        $cart = Cart::with('items.product')->firstOrCreate([
            'user_id' => Auth::id(),
        ]);

        return view('cart.index', compact('cart'));
    }

    // Add a product to the cart (or increase quantity if already there)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'quantity'   => ['required', 'integer', 'min:1'],
        ]);

        $product = Product::findOrFail($validated['product_id']);

        if (!$product->is_active) {
            return back()->withErrors(['product' => 'This product is no longer available.']);
        }

        $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);

        $item = $cart->items()->where('product_id', $product->id)->first();
        $newQuantity = $item ? $item->quantity + $validated['quantity'] : $validated['quantity'];

        // Don't let the cart hold more than what's currently in stock
        if ($newQuantity > $product->stock_quantity) {
            return back()->withErrors(['quantity' => "Only {$product->stock_quantity} left in stock."]);
        }

        $cart->items()->updateOrCreate(
            ['product_id' => $product->id],
            ['quantity' => $newQuantity]
        );

        return back()->with('success', 'Added to cart!');
    }

    // Update quantity of a single cart item
    public function update(Request $request, $itemId)
{
    $validated = $request->validate([
        'quantity' => ['required', 'integer', 'min:1'],
    ]);

    $cart = Cart::where('user_id', Auth::id())->firstOrFail();

    /** @var \App\Models\CartItem $item */
    $item = $cart->items()->where('id', $itemId)->firstOrFail();

    if ($validated['quantity'] > $item->product->stock_quantity) {
        return back()->withErrors(['quantity' => "Only {$item->product->stock_quantity} left in stock."]);
    }

    $item->update(['quantity' => $validated['quantity']]);

    return back()->with('success', 'Cart updated!');
}

    // Remove a single item
    public function destroy($itemId)
    {
        $cart = Cart::where('user_id', Auth::id())->firstOrFail();
        $cart->items()->where('id', $itemId)->delete();

        return back()->with('success', 'Item removed.');
    }
}