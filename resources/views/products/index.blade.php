<x-layout>
    <div class="min-h-screen bg-slate-50 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Header --}}
            <div class="mb-8">
                <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-4">
                    <div>
                        <p class="text-sm font-medium text-indigo-600 mb-1">
                            Explore our collection
                        </p>

                        <h1 class="text-3xl sm:text-4xl font-bold tracking-tight text-slate-900">
                            Our Products
                        </h1>

                        <p class="mt-2 text-slate-500">
                            Find the perfect products for you.
                        </p>
                    </div>

                    @if ($products->total() > 0)
                        <div class="text-sm text-slate-500">
                            Showing
                            <span class="font-semibold text-slate-800">
                                {{ $products->firstItem() }}–{{ $products->lastItem() }}
                            </span>
                            of
                            <span class="font-semibold text-slate-800">
                                {{ $products->total() }}
                            </span>
                            products
                        </div>
                    @endif
                </div>
            </div>

            {{-- Search & Filter --}}
            <div class="bg-white border border-slate-200 rounded-2xl shadow-sm p-4 sm:p-5 mb-8">
                <form method="GET" class="flex flex-col lg:flex-row gap-3">

                    {{-- Category --}}
                    <div class="relative lg:w-64">
                        <label class="sr-only" for="category">
                            Category
                        </label>

                        <select
                            id="category"
                            name="category"
                            onchange="this.form.submit()"
                            class="w-full appearance-none rounded-xl border border-slate-200 bg-slate-50
                                   px-4 py-3 pr-10 text-sm text-slate-700
                                   outline-none transition
                                   focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100"
                        >
                            <option value="">All Categories</option>

                            @foreach ($categories as $category)
                                <option
                                    value="{{ $category->slug }}"
                                    {{ request('category') === $category->slug ? 'selected' : '' }}
                                >
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>

                        <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center">
                            <svg
                                class="w-4 h-4 text-slate-400"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M19 9l-7 7-7-7"
                                />
                            </svg>
                        </div>
                    </div>

                    {{-- Search --}}
                    <div class="relative flex-1">
                        <label class="sr-only" for="search">
                            Search products
                        </label>

                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">
                            <svg
                                class="w-5 h-5 text-slate-400"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="m21 21-4.35-4.35m2.35-5.65a8 8 0 1 1-16 0 8 8 0 0 1 16 0Z"
                                />
                            </svg>
                        </div>

                        <input
                            id="search"
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Search products..."
                            class="w-full rounded-xl border border-slate-200 bg-slate-50
                                   py-3 pl-11 pr-4 text-sm text-slate-700
                                   placeholder:text-slate-400
                                   outline-none transition
                                   focus:border-indigo-500 focus:bg-white
                                   focus:ring-2 focus:ring-indigo-100"
                        />
                    </div>

                    {{-- Search Button --}}
                    <button
                        type="submit"
                        class="inline-flex items-center justify-center gap-2
                               rounded-xl bg-slate-900 px-6 py-3
                               text-sm font-semibold text-white
                               shadow-sm transition duration-200
                               hover:bg-indigo-600 hover:shadow-md
                               focus:outline-none focus:ring-2
                               focus:ring-indigo-500 focus:ring-offset-2"
                    >
                        <svg
                            class="w-4 h-4"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="m21 21-4.35-4.35m2.35-5.65a8 8 0 1 1-16 0 8 8 0 0 1 16 0Z"
                            />
                        </svg>

                        Search
                    </button>
                </form>
            </div>

            {{-- Products Grid --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">

                @forelse ($products as $product)

                    <a
                        href="{{ route('products.show', $product) }}"
                        class="group bg-white rounded-2xl overflow-hidden
                               border border-slate-200 shadow-sm
                               transition-all duration-300
                               hover:-translate-y-1
                               hover:shadow-xl hover:border-indigo-100"
                    >

                        {{-- Product Image --}}
                        <div class="relative overflow-hidden bg-slate-100">

                            @if ($product->image)

                                <img
                                    src="{{ asset('storage/' . $product->image) }}"
                                    alt="{{ $product->name }}"
                                    class="w-full h-56 object-cover
                                           transition-transform duration-500
                                           group-hover:scale-105"
                                >

                            @else

                                <div
                                    class="w-full h-56 flex flex-col items-center justify-center
                                           bg-gradient-to-br from-slate-100 to-slate-200
                                           text-slate-400"
                                >
                                    <svg
                                        class="w-12 h-12 mb-2"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="1.5"
                                            d="M3 5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5Z"
                                        />
                                        <path
                                            stroke-linecap="round"
                                            stroke-width="1.5"
                                            d="m3 16 5-5 4 4 3-3 6 6"
                                        />
                                    </svg>

                                    <span class="text-sm font-medium">
                                        No Image
                                    </span>
                                </div>

                            @endif

                            {{-- Stock Badge --}}
                            @if ($product->stock_quantity <= 0)

                                <div class="absolute top-3 left-3">
                                    <span
                                        class="inline-flex items-center rounded-full
                                               bg-red-50 px-3 py-1.5
                                               text-xs font-semibold text-red-600
                                               border border-red-100"
                                    >
                                        Out of stock
                                    </span>
                                </div>

                            @else

                                <div class="absolute top-3 left-3">
                                    <span
                                        class="inline-flex items-center rounded-full
                                               bg-white/90 backdrop-blur-sm
                                               px-3 py-1.5
                                               text-xs font-semibold text-emerald-600
                                               shadow-sm"
                                    >
                                        In stock
                                    </span>
                                </div>

                            @endif

                            {{-- View Icon --}}
                            <div
                                class="absolute right-3 bottom-3
                                       h-10 w-10 rounded-full
                                       bg-white/90 backdrop-blur-sm
                                       flex items-center justify-center
                                       text-slate-700 shadow-sm
                                       opacity-0 translate-y-2
                                       transition-all duration-300
                                       group-hover:opacity-100
                                       group-hover:translate-y-0"
                            >
                                <svg
                                    class="w-5 h-5"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M9 5l7 7-7 7"
                                    />
                                </svg>
                            </div>
                        </div>

                        {{-- Product Details --}}
                        <div class="p-5">

                            <div class="flex items-start justify-between gap-3">

                                <h2
                                    class="text-lg font-semibold text-slate-900
                                           leading-snug line-clamp-2
                                           transition-colors duration-200
                                           group-hover:text-indigo-600"
                                >
                                    {{ $product->name }}
                                </h2>

                            </div>

                            <div class="mt-4 flex items-center justify-between">

                                <p class="text-xl font-bold text-slate-900">
                                    ${{ number_format($product->price, 2) }}
                                </p>

                                @if ($product->stock_quantity > 0)
                                    <span class="text-xs text-slate-400">
                                        Available
                                    </span>
                                @endif

                            </div>

                            <div
                                class="mt-4 flex items-center text-sm font-medium
                                       text-indigo-600
                                       transition-all duration-200
                                       group-hover:gap-2"
                            >
                                <span>View Product</span>

                                <svg
                                    class="w-4 h-4 ml-1 transition-transform duration-200
                                           group-hover:translate-x-1"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M9 5l7 7-7 7"
                                    />
                                </svg>
                            </div>

                        </div>
                    </a>

                @empty

                    {{-- Empty State --}}
                    <div class="col-span-full">

                        <div
                            class="bg-white border border-slate-200
                                   rounded-2xl p-10 sm:p-16
                                   text-center shadow-sm"
                        >
                            <div
                                class="mx-auto flex h-16 w-16 items-center justify-center
                                       rounded-full bg-slate-100 text-slate-400"
                            >
                                <svg
                                    class="w-8 h-8"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.5"
                                        d="m21 21-4.35-4.35m2.35-5.65a8 8 0 1 1-16 0 8 8 0 0 1 16 0Z"
                                    />
                                </svg>
                            </div>

                            <h2 class="mt-5 text-xl font-bold text-slate-900">
                                No products found
                            </h2>

                            <p class="mt-2 text-slate-500 max-w-md mx-auto">
                                We couldn't find any products matching your search.
                                Try changing your search or category.
                            </p>
                        </div>

                    </div>

                @endforelse

            </div>

            {{-- Pagination --}}
            @if ($products->hasPages())
                <div class="mt-10 flex justify-center">
                    <div
                        class="bg-white border border-slate-200
                               rounded-xl px-4 py-3 shadow-sm"
                    >
                        {{ $products->links() }}
                    </div>
                </div>
            @endif

        </div>
    </div>
</x-layout>
