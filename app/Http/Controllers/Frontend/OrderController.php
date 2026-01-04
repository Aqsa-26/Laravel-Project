<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = \App\Models\Order::where('user_id', auth()->id())
                    ->with('items.product')
                    ->orderBy('created_at', 'desc')
                    ->get();
                    
        return view('frontend.orders.index', compact('orders'));
    }

    public function success()
    {
        return view('frontend.orders.success');
    }
}
