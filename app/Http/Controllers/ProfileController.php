<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function update(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        $user->update([
            'username' => $request->username,
            'email' => $request->email,
        ]);

        return back()->with('success', 'Profile updated successfully');
    }
}