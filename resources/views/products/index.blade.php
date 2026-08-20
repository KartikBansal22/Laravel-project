<x-layout>
    <div class="mb-8 text-center">
        <h1 class="text-3xl font-bold text-slate-800">Our Products</h1>
        <p class="text-slate-500 mt-1">Browse the latest arrivals at Whitecliffe Clothhouse</p>
    </div>

    <div class="bg-white rounded-xl shadow-sm p-4 mb-8">
        <form method="GET" class="flex flex-col sm:flex-row gap-3">
            <select name="category" onchange="this.form.submit()"
                    class="border border-slate-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-slate-800">
                <option value="">All Categories</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->slug }}" {{ request('category') === $category->slug ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search products..."
                   class="flex-1 border border-slate-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-slate-800">
            <button type="submit"
                    class="bg-slate-800 hover:bg-slate-700 transition-colors text-white px-6 py-2 rounded-lg font-medium">
                Search
            </button>
        </form>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @forelse ($products as $product)
            <a href="{{ route('products.show', $product) }}"
               class="group bg-white rounded-xl shadow-sm hover:shadow-xl transition-shadow duration-300 overflow-hidden flex flex-col">
                <div class="relative overflow-hidden h-56 bg-slate-100">
                    @if ($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-slate-400 text-sm">No Image</div>
                    @endif

                    @if ($product->stock_quantity <= 0)
                        <span class="absolute top-2 right-2 bg-red-600 text-white text-xs font-semibold px-2 py-1 rounded-full">
                            Out of stock
                        </span>
                    @endif
                </div>

                <div class="p-4 flex flex-col flex-1">
                    <p class="font-semibold text-slate-800 line-clamp-1">{{ $product->name }}</p>
                    <div class="mt-auto pt-2 flex items-center justify-between">
                        <p class="text-lg font-bold text-slate-900">${{ number_format($product->price, 2) }}</p>
                        <span class="text-sm text-slate-400 group-hover:text-slate-800 transition-colors">View &rarr;</span>
                    </div>
                </div>
            </a>
        @empty
            <div class="col-span-full text-center py-16">
                <p class="text-slate-400 text-lg">No products found.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $products->links() }}
    </div>
</x-layout>
