<x-layout>
    <h1 class="text-2xl font-bold mb-6">Edit User</h1>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form action="{{ route('admin.users.update', $user) }}" method="POST" class="bg-white p-6 rounded shadow space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block font-semibold mb-1">Username</label>
            <input type="text" name="username" value="{{ old('username', $user->username) }}" class="w-full border rounded p-2" required>
        </div>

        <div>
            <label class="block font-semibold mb-1">Email</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full border rounded p-2" required>
        </div>

        <div>
            <label class="block font-semibold mb-1">Role</label>
            <select name="role" class="w-full border rounded p-2">
                <option value="customer" {{ $user->role === 'customer' ? 'selected' : '' }}>Customer</option>
                <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
            </select>
        </div>

        <button type="submit" class="bg-slate-800 text-white px-6 py-2 rounded">Update User</button>
    </form>
</x-layout>