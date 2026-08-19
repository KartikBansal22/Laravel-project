<x-layout>
    <h1 class="text-2xl font-bold mb-2">Order #{{ $order->id }}</h1>
    <p class="mb-4">Customer: {{ $order->user->username }} ({{ $order->user->email }})</p>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

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

    <p class="mb-4">Current status: <span class="font-semibold capitalize">{{ $order->status }}</span></p>

    <div class="flex gap-2">
        @foreach (\App\Models\Order::allowedTransitions()[$order->status] ?? [] as $nextStatus)
            <form action="{{ route('admin.orders.updateStatus', $order) }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="status" value="{{ $nextStatus }}">
                <button type="submit" class="bg-slate-800 text-white px-4 py-2 rounded hover:bg-slate-700 capitalize">
                    Mark as {{ $nextStatus }}
                </button>
            </form>
        @endforeach
    </div>
</x-layout>