<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class AdminDashboardController extends Controller
{
    public function index()
    {
      
        $baseQuery = Order::where('status', '!=', Order::STATUS_CANCELLED);

        $todayRevenue = (clone $baseQuery)->whereDate('created_at', Carbon::today())->sum('total_amount');
        $weekRevenue  = (clone $baseQuery)->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->sum('total_amount');
        $monthRevenue = (clone $baseQuery)->whereMonth('created_at', Carbon::now()->month)->whereYear('created_at', Carbon::now()->year)->sum('total_amount');

        $totalOrders = (clone $baseQuery)->count();
        $pendingOrders = Order::where('status', Order::STATUS_PENDING)->count();

    
        $bestSellers = OrderItem::select('product_id', DB::raw('SUM(quantity) as total_sold'))
            ->whereHas('order', fn ($q) => $q->where('status', '!=', Order::STATUS_CANCELLED))
            ->groupBy('product_id')
            ->orderByDesc('total_sold')
            ->with('product')
            ->take(5)
            ->get();

       
        $lowStockProducts = Product::whereColumn('stock_quantity', '<=', 'reorder_threshold')
            ->where('is_active', true)
            ->orderBy('stock_quantity')
            ->get();

  
        $dailyRevenue = (clone $baseQuery)
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(total_amount) as revenue'))
            ->where('created_at', '>=', Carbon::now()->subDays(6)->startOfDay())
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->keyBy('date');

        
        $trend = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->format('Y-m-d');
            $trend[$date] = (float) ($dailyRevenue[$date]->revenue ?? 0);
        }
        
        return view('admin.dashboard', compact(
            'todayRevenue', 'weekRevenue', 'monthRevenue',
            'totalOrders', 'pendingOrders',
            'bestSellers', 'lowStockProducts', 'trend'
        ));
    }
}