<x-layout>
    <h1 class="text-2xl font-bold mb-6">Edit Product</h1>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data"
          class="bg-white p-6 rounded shadow space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block font-semibold mb-1">Name</label>
            <input type="text" name="name" value="{{ old('name', $product->name) }}" class="w-full border rounded p-2" required>
        </div>

        <div>
            <label class="block font-semibold mb-1">Category</label>
            <select name="category_id" class="w-full border rounded p-2">
                <option value="">Uncategorized</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block font-semibold mb-1">Description</label>
            <textarea name="description" rows="4" class="w-full border rounded p-2">{{ old('description', $product->description) }}</textarea>
        </div>

        <div class="grid grid-cols-3 gap-4">
            <div>
                <label class="block font-semibold mb-1">Price</label>
                <input type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}" class="w-full border rounded p-2" required>
            </div>
            <div>
                <label class="block font-semibold mb-1">Stock Quantity</label>
                <input type="number" name="stock_quantity" value="{{ old('stock_quantity', $product->stock_quantity) }}" class="w-full border rounded p-2" required>
            </div>
            <div>
                <label class="block font-semibold mb-1">Reorder Threshold</label>
                <input type="number" name="reorder_threshold" value="{{ old('reorder_threshold', $product->reorder_threshold) }}" class="w-full border rounded p-2">
            </div>
        </div>

        <div>
            <label class="inline-flex items-center gap-2">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $product->is_active) ? 'checked' : '' }}>
                Active (visible in store)
            </label>
        </div>

        <div>
            <label class="block font-semibold mb-1">Replace Image</label>
            @if ($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" class="w-32 h-32 object-cover rounded mb-2">
            @endif
            <input type="file" name="image" accept="image/*">
        </div>

        <button type="submit" class="bg-slate-800 text-white px-6 py-2 rounded">Update Product</button>
    </form>
</x-layout>