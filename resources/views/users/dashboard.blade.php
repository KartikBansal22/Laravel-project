<x-layout>
    <h1 class="text-2xl font-bold mb-6">Welcome, {{ $user->username }}</h1>

    <div class="flex gap-4 mb-6">
        <a href="{{ route('orders.index') }}" class="bg-slate-800 text-white px-4 py-2 rounded">My Orders</a>
        <a href="{{ route('cart.index') }}" class="bg-slate-800 text-white px-4 py-2 rounded">My Cart</a>
        <a href="{{ route('products.index') }}" class="bg-slate-800 text-white px-4 py-2 rounded">Shop Products</a>
    </div>

    <h2 class="text-xl font-semibold mb-4">Recent Orders</h2>

    @if ($orders->isEmpty())
        <p>You haven't placed any orders yet.</p>
    @else
        <table class="w-full bg-white rounded shadow">
            <thead>
                <tr class="text-left border-b">
                    <th class="p-3">Order #</th>
                    <th class="p-3">Date</th>
                    <th class="p-3">Total</th>
                    <th class="p-3">Status</th>
                    <th class="p-3"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr class="border-b">
                        <td class="p-3">#{{ $order->id }}</td>
                        <td class="p-3">{{ $order->created_at->format('d M Y') }}</td>
                        <td class="p-3">${{ number_format($order->total_amount, 2) }}</td>
                        <td class="p-3 capitalize">{{ $order->status }}</td>
                        <td class="p-3"><a href="{{ route('orders.show', $order) }}" class="underline">View</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">{{ $orders->links() }}</div>
    @endif
</x-layout>