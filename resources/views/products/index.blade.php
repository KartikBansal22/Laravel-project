<x-layout>
    <h1 class="text-2xl font-bold mb-6">Our Products</h1>

    <div class="flex gap-4 mb-6">
        <form method="GET" class="flex gap-2">
            <select name="category" onchange="this.form.submit()" class="border rounded px-3 py-2">
                <option value="">All Categories</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->slug }}" {{ request('category') === $category->slug ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search products..."
                   class="border rounded px-3 py-2">
            <button type="submit" class="bg-slate-800 text-white px-4 py-2 rounded">Search</button>
        </form>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        @forelse ($products as $product)
            <a href="{{ route('products.show', $product) }}" class="bg-white rounded shadow hover:shadow-lg overflow-hidden">
                @if ($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" class="w-full h-48 object-cover">
                @else
                    <div class="w-full h-48 bg-slate-200 flex items-center justify-center text-slate-400">No Image</div>
                @endif
                <div class="p-4">
                    <p class="font-semibold">{{ $product->name }}</p>
                    <p class="text-slate-600">${{ number_format($product->price, 2) }}</p>
                    @if ($product->stock_quantity <= 0)
                        <p class="text-red-600 text-sm mt-1">Out of stock</p>
                    @endif
                </div>
            </a>
        @empty
            <p>No products found.</p>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $products->links() }}
    </div>
</x-layout>
