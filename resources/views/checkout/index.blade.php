<x-layout>
    <h1 class="text-2xl font-bold mb-6">Checkout</h1>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <div class="bg-white p-4 rounded shadow mb-6">
        <h2 class="font-semibold mb-3">Order Summary</h2>
        @foreach ($cart->items as $item)
            <div class="flex justify-between py-1">
                <span>{{ $item->product->name }} × {{ $item->quantity }}</span>
                <span>${{ number_format($item->subtotal(), 2) }}</span>
            </div>
        @endforeach
        <div class="flex justify-between font-bold border-t mt-2 pt-2">
            <span>Total</span>
            <span>${{ number_format($cart->total(), 2) }}</span>
        </div>
    </div>

    <form action="{{ route('checkout.store') }}" method="POST" class="bg-white p-4 rounded shadow">
        @csrf
        <label class="block mb-2 font-semibold">Shipping Address</label>
        <textarea name="shipping_address" rows="3" class="w-full border rounded p-2" required>{{ old('shipping_address') }}</textarea>

        <button type="submit" class="mt-4 bg-green-700 text-white px-6 py-3 rounded hover:bg-green-800">
            Place Order
        </button>
    </form>
</x-layout>