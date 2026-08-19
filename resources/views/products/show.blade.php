<x-layout>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 bg-white p-6 rounded shadow">
        <div>
            @if ($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" class="w-full rounded">
            @else
                <div class="w-full h-80 bg-slate-200 flex items-center justify-center text-slate-400">No Image</div>
            @endif
        </div>

        <div>
            <h1 class="text-2xl font-bold">{{ $product->name }}</h1>
            <p class="text-slate-500 mb-2">{{ $product->category->name ?? 'Uncategorized' }}</p>
            <p class="text-2xl font-semibold mb-4">${{ number_format($product->price, 2) }}</p>
            <p class="mb-4">{{ $product->description }}</p>
            <p class="mb-4 text-sm text-slate-500">{{ $product->stock_quantity }} in stock</p>

            @auth
                <form action="{{ route('cart.store') }}" method="POST" class="flex items-center gap-3">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock_quantity }}"
                           class="w-20 border rounded px-2 py-1">
                    <button type="submit" class="bg-slate-800 text-white px-4 py-2 rounded hover:bg-slate-700"
                            {{ $product->stock_quantity <= 0 ? 'disabled' : '' }}>
                        {{ $product->stock_quantity > 0 ? 'Add to Cart' : 'Out of Stock' }}
                    </button>
                </form>
            @else
                <p><a href="{{ route('login') }}" class="underline">Log in</a> to add this to your cart.</p>
            @endauth
        </div>
    </div>
</x-layout>