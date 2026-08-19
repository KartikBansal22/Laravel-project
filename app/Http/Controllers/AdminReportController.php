<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class AdminReportController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'from' => ['nullable', 'date'],
            'to'   => ['nullable', 'date', 'after_or_equal:from'],
        ]);

       
        $from = $request->filled('from')
            ? Carbon::parse($request->from)->startOfDay()
            : Carbon::now()->subDays(29)->startOfDay();

        $to = $request->filled('to')
            ? Carbon::parse($request->to)->endOfDay()
            : Carbon::now()->endOfDay();

        $orders = Order::with('user', 'items.product')
            ->whereBetween('created_at', [$from, $to])
            ->latest()
            ->get();

        $totalOrders  = $orders->count();
        $totalRevenue = $orders->where('status', '!=', Order::STATUS_CANCELLED)->sum('total_amount');
        $cancelledCount = $orders->where('status', Order::STATUS_CANCELLED)->count();

       
        $statusCounts = $orders->groupBy('status')->map->count();

        return view('admin.reports.index', compact(
            'orders', 'from', 'to', 'totalOrders', 'totalRevenue', 'cancelledCount', 'statusCounts'
        ));
    }
}