<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;

class DashboardController extends Controller
{
    /**
     * Show the admin dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $productsCount = Product::count();
        $ordersCount = Order::count();
        $usersCount = User::count();

        // Calculate revenue
        // Assuming 'total_price' based on legacy code check priority, but will check schema later.
        // Legacy: total_price -> amount -> total
        $revenue = Order::where('status', 'completed')->sum('total_price');

        $recentOrders = Order::with('user')->latest()->take(5)->get();
        $recentProducts = Product::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'productsCount',
            'ordersCount',
            'usersCount',
            'revenue',
            'recentOrders',
            'recentProducts'
        ));
    }
}
