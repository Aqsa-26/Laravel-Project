<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::latest()->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load(['user', 'items.product']);
        return view('admin.orders.show', compact('order'));
    }

    public function edit(Order $order)
    {
        // Not really needed if we do status update in show or index, but consistent with CRUD
        return view('admin.orders.edit', compact('order'));
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled',
            'phone' => 'nullable|string',
            'shipping_address' => 'nullable|string'
        ]);

        $order->update([
            'status' => $request->status,
            'phone' => $request->phone ?? $order->phone,
            'shipping_address' => $request->shipping_address ?? $order->shipping_address
        ]);

        return redirect()->back()->with('success', 'Order status updated successfully.');
    }
}
