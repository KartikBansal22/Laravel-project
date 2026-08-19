<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
  
    public function register(Request $request)
    {
      
        $fields = $request->validate([
            'username' => ['required', 'max:255'],
            'email' => ['required', 'max:255', 'email', 'unique:users'],
            'password' => ['required', 'min:3', 'confirmed'],
        ]);

        
        $user = User::create([
            'username' => $fields['username'],
            'email' => $fields['email'],
            'password' => Hash::make($fields['password']),
            'role' => 'user' 
        ]);

      
        Auth::login($user);

      
        return redirect()->route('dashboard');
    }


  
    public function login(Request $request)
{
    $fields = $request->validate([
        'email' => ['required', 'max:255', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($fields, $request->remember)) {
        $request->session()->regenerate();

        if (auth()->user()->role === 'admin') {
            return redirect('/admin/dashboard'); 
        }

        return redirect('/dashboard');
    }

    return back()->withErrors(['failed' => 'Wrong email or password']);
}

 
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}