<x-layout>
    <h1 class="text-2xl font-bold mb-6">Sales Report</h1>

    <form method="GET" class="bg-white p-4 rounded shadow flex flex-wrap items-end gap-4 mb-6">
        <div>
            <label class="block text-sm font-semibold mb-1">From</label>
            <input type="date" name="from" value="{{ $from->format('Y-m-d') }}" class="border rounded p-2">
        </div>
        <div>
            <label class="block text-sm font-semibold mb-1">To</label>
            <input type="date" name="to" value="{{ $to->format('Y-m-d') }}" class="border rounded p-2">
        </div>
        <button type="submit" class="bg-slate-800 text-white px-6 py-2 rounded">Apply</button>
        <a href="{{ route('admin.reports.index') }}" class="text-sm underline text-slate-500">Reset to last 30 days</a>
    </form>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
        <div class="bg-white p-4 rounded shadow">
            <p class="text-sm text-slate-500">Total Orders</p>
            <p class="text-2xl font-bold">{{ $totalOrders }}</p>
        </div>
        <div class="bg-white p-4 rounded shadow">
            <p class="text-sm text-slate-500">Total Revenue</p>
            <p class="text-2xl font-bold">${{ number_format($totalRevenue, 2) }}</p>
        </div>
        <div class="bg-white p-4 rounded shadow">
            <p class="text-sm text-slate-500">Cancelled</p>
            <p class="text-2xl font-bold text-red-600">{{ $cancelledCount }}</p>
        </div>
        <div class="bg-white p-4 rounded shadow">
            <p class="text-sm text-slate-500">Date Range</p>
            <p class="text-sm font-semibold">{{ $from->format('d M Y') }} – {{ $to->format('d M Y') }}</p>
        </div>
    </div>

    <div class="bg-white p-4 rounded shadow mb-8">
        <h2 class="font-semibold mb-3">Orders by Status</h2>
        <div class="flex flex-wrap gap-3">
            @forelse ($statusCounts as $status => $count)
                <span class="bg-slate-100 px-3 py-1 rounded-full text-sm capitalize">
                    {{ $status }}: <strong>{{ $count }}</strong>
                </span>
            @empty
                <p class="text-slate-400 text-sm">No orders in this range.</p>
            @endforelse
        </div>
    </div>

    <div class="bg-white rounded shadow overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="text-left border-b">
                    <th class="p-3">Order #</th>
                    <th class="p-3">Customer</th>
                    <th class="p-3">Date</th>
                    <th class="p-3">Items</th>
                    <th class="p-3">Total</th>
                    <th class="p-3">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($orders as $order)
                    <tr class="border-b">
                        <td class="p-3">
                            <a href="{{ route('admin.orders.show', $order) }}" class="underline">#{{ $order->id }}</a>
                        </td>
                        <td class="p-3">{{ $order->user->username ?? '—' }}</td>
                        <td class="p-3">{{ $order->created_at->format('d M Y, h:i A') }}</td>
                        <td class="p-3">{{ $order->items->sum('quantity') }}</td>
                        <td class="p-3">${{ number_format($order->total_amount, 2) }}</td>
                        <td class="p-3 capitalize">{{ $order->status }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="p-6 text-center text-slate-400">No orders found in this date range.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-layout>