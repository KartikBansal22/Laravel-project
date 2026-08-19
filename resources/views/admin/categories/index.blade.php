<x-layout>
    <h1 class="text-2xl font-bold mb-6">Categories</h1>

    @if (session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
    @endif
    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form action="{{ route('admin.categories.store') }}" method="POST" class="flex gap-2 mb-6">
        @csrf
        <input type="text" name="name" placeholder="New category name" class="border rounded px-3 py-2 flex-1" required>
        <button type="submit" class="bg-slate-800 text-white px-4 py-2 rounded">Add</button>
    </form>

    <table class="w-full bg-white rounded shadow">
        <thead>
            <tr class="text-left border-b">
                <th class="p-3">Name</th>
                <th class="p-3">Products</th>
                <th class="p-3"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr class="border-b">
                    <td class="p-3">{{ $category->name }}</td>
                    <td class="p-3">{{ $category->products_count }}</td>
                    <td class="p-3">
                        <form action="{{ route('admin.categories.destroy', $category) }}" method="POST"
                              onsubmit="return confirm('Delete this category?')">
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