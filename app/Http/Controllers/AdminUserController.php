<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::latest()->get();
        return view('admin.users.index', compact('users'));
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'username' => ['required', 'max:255'],
            'email'    => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'role'     => ['required', 'in:customer,admin'],
        ]);

       
        if ($user->id === auth()->id() && $validated['role'] !== 'admin') {
            return back()->withErrors(['role' => 'You cannot remove your own admin role.']);
        }

        $user->update($validated);

        return redirect()->route('admin.users.index')->with('success', 'User updated!');
    }

    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->withErrors(['user' => 'You cannot delete your own account.']);
        }

        $user->delete();

        return back()->with('success', 'User deleted!');
    }
}