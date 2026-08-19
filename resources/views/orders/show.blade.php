<x-layout>
    <h1 class="text-2xl font-bold mb-2">Order #{{ $order->id }}</h1>
    <p class="mb-6">Status: <span class="font-semibold capitalize">{{ $order->status }}</span></p>

    <div class="bg-white p-4 rounded shadow mb-6">
        @foreach ($order->items as $item)
            <div class="flex justify-between py-1">
                <span>{{ $item->product->name }} × {{ $item->quantity }}</span>
                <span>${{ number_format($item->quantity * $item->unit_price, 2) }}</span>
            </div>
        @endforeach
        <div class="flex justify-between font-bold border-t mt-2 pt-2">
            <span>Total</span>
            <span>${{ number_format($order->total_amount, 2) }}</span>
        </div>
    </div>

    <p><strong>Shipping to:</strong> {{ $order->shipping_address }}</p>
</x-layout>