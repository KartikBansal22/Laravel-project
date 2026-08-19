<x-layout>
    <h1 class="text-2xl font-bold mb-6">Users</h1>

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

    <table class="w-full bg-white rounded shadow">
        <thead>
            <tr class="text-left border-b">
                <th class="p-3">Username</th>
                <th class="p-3">Email</th>
                <th class="p-3">Role</th>
                <th class="p-3"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr class="border-b">
                    <td class="p-3">{{ $user->username }}</td>
                    <td class="p-3">{{ $user->email }}</td>
                    <td class="p-3 capitalize">{{ $user->role }}</td>
                    <td class="p-3 flex gap-3">
                        <a href="{{ route('admin.users.edit', $user) }}" class="underline text-sm">Edit</a>
                        @if ($user->id !== auth()->id())
                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST"
                                  onsubmit="return confirm('Delete this user?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 underline text-sm">Delete</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-layout>