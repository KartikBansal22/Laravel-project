<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        $orders = $user->orders()->latest()->paginate(6);

        return view('users.dashboard', [
            'orders' => $orders,
            'user' => $user,
        ]);
    }
}