<x-layout>
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Products</h1>
        <a href="{{ route('admin.products.create') }}" class="bg-slate-800 text-white px-4 py-2 rounded">
            + New Product
        </a>
    </div>

    @if (session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
    @endif

    <table class="w-full bg-white rounded shadow">
        <thead>
            <tr class="text-left border-b">
                <th class="p-3">Name</th>
                <th class="p-3">Category</th>
                <th class="p-3">Price</th>
                <th class="p-3">Stock</th>
                <th class="p-3">Active</th>
                <th class="p-3"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr class="border-b {{ $product->isLowStock() ? 'bg-yellow-50' : '' }}">
                    <td class="p-3">{{ $product->name }}</td>
                    <td class="p-3">{{ $product->category->name ?? '—' }}</td>
                    <td class="p-3">${{ number_format($product->price, 2) }}</td>
                    <td class="p-3">
                        {{ $product->stock_quantity }}
                        @if ($product->isLowStock())
                            <span class="text-yellow-700 text-xs">(low)</span>
                        @endif
                    </td>
                    <td class="p-3">{{ $product->is_active ? 'Yes' : 'No' }}</td>
                    <td class="p-3 flex gap-3">
                        <a href="{{ route('admin.products.edit', $product) }}" class="underline text-sm">Edit</a>
                        <form action="{{ route('admin.products.destroy', $product) }}" method="POST"
                              onsubmit="return confirm('Delete this product?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 underline text-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-layout>