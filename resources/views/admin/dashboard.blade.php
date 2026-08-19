<x-layout>
    <h1 class="text-2xl font-bold mb-6">Admin Dashboard</h1>

    <div class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-8">
        <div class="bg-white p-4 rounded shadow">
            <p class="text-sm text-slate-500">Today's Revenue</p>
            <p class="text-2xl font-bold">${{ number_format($todayRevenue, 2) }}</p>
        </div>
        <div class="bg-white p-4 rounded shadow">
            <p class="text-sm text-slate-500">This Week</p>
            <p class="text-2xl font-bold">${{ number_format($weekRevenue, 2) }}</p>
        </div>
        <div class="bg-white p-4 rounded shadow">
            <p class="text-sm text-slate-500">This Month</p>
            <p class="text-2xl font-bold">${{ number_format($monthRevenue, 2) }}</p>
        </div>
        <div class="bg-white p-4 rounded shadow">
            <p class="text-sm text-slate-500">Total Orders</p>
            <p class="text-2xl font-bold">{{ $totalOrders }}</p>
        </div>
        <div class="bg-white p-4 rounded shadow">
            <p class="text-sm text-slate-500">Pending Orders</p>
            <p class="text-2xl font-bold text-yellow-600">{{ $pendingOrders }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <div class="bg-white p-4 rounded shadow">
            <h2 class="font-semibold mb-3">Best Sellers</h2>
            @forelse ($bestSellers as $item)
                <div class="flex justify-between py-1 border-b">
                    <span>{{ $item->product->name ?? 'Unknown' }}</span>
                    <span class="font-semibold">{{ $item->total_sold }} sold</span>
                </div>
            @empty
                <p class="text-slate-400">No sales yet.</p>
            @endforelse
        </div>

        <div class="bg-white p-4 rounded shadow">
            <h2 class="font-semibold mb-3">Low Stock Alerts</h2>
            @forelse ($lowStockProducts as $product)
                <div class="flex justify-between py-1 border-b">
                    <span>{{ $product->name }}</span>
                    <span class="font-semibold text-red-600">{{ $product->stock_quantity }} left</span>
                </div>
            @empty
                <p class="text-slate-400">All stock levels healthy.</p>
            @endforelse
        </div>
    </div>

    <div class="bg-white p-4 rounded shadow mb-8">
    <h2 class="font-semibold mb-3">Revenue — Last 7 Days</h2>

    @php
        $max = max(array_values($trend));
        $max = $max > 0 ? $max : 1;
    @endphp

    <div class="flex items-end gap-4 h-48 border-b border-slate-200">

        @foreach ($trend as $date => $revenue)

            @php
                $height = ($revenue / $max) * 100;
            @endphp

            <div class="flex-1 h-full flex flex-col justify-end items-center">

                {{-- Amount --}}
                <span class="text-xs text-slate-600 mb-1">
                    ${{ number_format($revenue, 2) }}
                </span>

                {{-- Bar --}}
                <div
                    class="w-full bg-slate-800 rounded-t"
                    style="height: {{ $height }}%; min-height: {{ $revenue > 0 ? '8px' : '0' }};"
                ></div>

                {{-- Day --}}
                <span class="text-xs text-slate-500 mt-2">
                    {{ \Carbon\Carbon::parse($date)->format('D') }}
                </span>

            </div>

        @endforeach

    </div>
</div>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <a href="{{ route('admin.products.index') }}" class="bg-white p-6 rounded shadow hover:shadow-lg">
            <p class="font-semibold">Products</p>
        </a>
        <a href="{{ route('admin.categories.index') }}" class="bg-white p-6 rounded shadow hover:shadow-lg">
            <p class="font-semibold">Categories</p>
        </a>
        <a href="{{ route('admin.orders.index') }}" class="bg-white p-6 rounded shadow hover:shadow-lg">
            <p class="font-semibold">Orders</p>
        </a>
        <a href="{{ route('admin.users.index') }}" class="bg-white p-6 rounded shadow hover:shadow-lg">
            <p class="font-semibold">Users</p>
        </a>
    </div>
</x-layout>