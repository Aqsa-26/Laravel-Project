<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        // 1. Total (Completed) Revenue
        $totalRevenue = \App\Models\Order::where('status', 'completed')->sum('total_price');

        // 2. Total Orders
        $totalOrders = \App\Models\Order::count();
        $pendingOrders = \App\Models\Order::where('status', 'pending')->count();

        // 3. User Stats
        $totalCustomers = \App\Models\User::where('role', 'user')->count();

        // 4. Product Stats
        $totalProducts = \App\Models\Product::count();
        $lowStockProducts = \App\Models\Product::where('stock', '<', 5)->count();

        // 5. Recent Orders
        $recentOrders = \App\Models\Order::with('user')->latest()->take(5)->get();

        return view('admin.reports.index', compact(
            'totalRevenue', 
            'totalOrders', 
            'pendingOrders',
            'totalCustomers',
            'totalProducts',
            'lowStockProducts',
            'recentOrders'
        ));
    }
}
