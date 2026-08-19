<x-layout>
    <h1 class="text-2xl font-bold mb-6">Your Cart</h1>

    @if ($cart->items->isEmpty())
        <p>Your cart is empty. <a href="{{ route('products.index') }}" class="underline">Browse products</a>.</p>
    @else
        <div class="space-y-4">
            @foreach ($cart->items as $item)
                <div class="flex items-center justify-between bg-white p-4 rounded shadow">
                    <div>
                        <p class="font-semibold">{{ $item->product->name }}</p>
                        <p class="text-sm text-slate-500">${{ number_format($item->product->price, 2) }} each</p>
                    </div>

                    <form action="{{ route('cart.update', $item->id) }}" method="POST" class="flex items-center gap-2">
                        @csrf
                        @method('PUT')
                        <input type="number" name="quantity" value="{{ $item->quantity }}" min="1"
                               max="{{ $item->product->stock_quantity }}" class="w-16 border rounded px-2 py-1">
                        <button type="submit" class="text-sm underline">Update</button>
                    </form>

                    <p class="font-semibold">${{ number_format($item->subtotal(), 2) }}</p>

                    <form action="{{ route('cart.destroy', $item->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 text-sm underline">Remove</button>
                    </form>
                </div>
            @endforeach
        </div>

        <div class="mt-6 flex items-center justify-between">
            <p class="text-xl font-bold">Total: ${{ number_format($cart->total(), 2) }}</p>
            <a href="{{ route('checkout.index') }}" class="bg-green-700 text-white px-6 py-3 rounded hover:bg-green-800">
                Proceed to Checkout
            </a>
        </div>
    @endif
</x-layout>