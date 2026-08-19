<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with('user')->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $orders = $query->paginate(15)->withQueryString();

        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load('items.product', 'user');
        return view('admin.orders.show', compact('order'));
    }

    
    public function updateStatus(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => ['required', 'string'],
        ]);

        if (!$order->canTransitionTo($validated['status'])) {
            return back()->withErrors([
                'status' => "Cannot move order from \"{$order->status}\" to \"{$validated['status']}\".",
            ]);
        }

        if ($validated['status'] === Order::STATUS_CANCELLED) {
            $order->load('items');
            $order->cancelAndRestock();
        } else {
            $order->update(['status' => $validated['status']]);
        }

        return back()->with('success', "Order #{$order->id} moved to {$validated['status']}.");
    }
}