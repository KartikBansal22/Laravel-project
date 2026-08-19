<x-layout>
    <h1 class="text-2xl font-bold mb-6">Orders</h1>

    <form method="GET" class="mb-4">
        <select name="status" onchange="this.form.submit()" class="border rounded px-3 py-2">
            <option value="">All statuses</option>
            @foreach (['pending', 'confirmed', 'packed', 'shipped', 'delivered', 'cancelled'] as $status)
                <option value="{{ $status }}" {{ request('status') === $status ? 'selected' : '' }}>
                    {{ ucfirst($status) }}
                </option>
            @endforeach
        </select>
    </form>

    <table class="w-full bg-white rounded shadow">
        <thead>
            <tr class="text-left border-b">
                <th class="p-3">Order #</th>
                <th class="p-3">Customer</th>
                <th class="p-3">Total</th>
                <th class="p-3">Status</th>
                <th class="p-3">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr class="border-b">
                    <td class="p-3">
                        <a href="{{ route('admin.orders.show', $order) }}" class="underline">#{{ $order->id }}</a>
                    </td>
                    <td class="p-3">{{ $order->user->username }}</td>
                    <td class="p-3">${{ number_format($order->total_amount, 2) }}</td>
                    <td class="p-3 capitalize">{{ $order->status }}</td>
                    <td class="p-3">
                        <a href="{{ route('admin.orders.show', $order) }}" class="text-sm underline">Manage</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $orders->links() }}
</x-layout>