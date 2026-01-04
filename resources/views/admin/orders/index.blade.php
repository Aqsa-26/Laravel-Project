@extends('layouts.admin')

@section('content')
<div class="header-actions" style="margin-bottom: 20px;">
    <h1>Orders</h1>
</div>

<div class="content-card">
    <table class="admin-table">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>User</th>
                <th>Total Price</th>
                <th>Status</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $order)
                <tr>
                    <td>#{{ $order->id }}</td>
                    <td>{{ $order->user ? $order->user->name : 'Guest' }}</td>
                    <td>Rs. {{ number_format($order->total_price, 2) }}</td>
                    <td>
                        <span class="status-badge status-{{ $order->status }}" style="padding: 5px 10px; border-radius: 4px; color: white; background: {{ $order->status == 'completed' ? 'green' : ($order->status == 'pending' ? 'orange' : 'gray') }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </td>
                    <td>{{ $order->created_at->format('d M Y') }}</td>
                    <td>
                        <a href="{{ route('admin.orders.edit', $order->id) }}" class="btn-primary" style="padding: 5px 10px; text-decoration: none; font-size: 12px; background: #2196f3; margin-right: 5px;">Edit</a>
                        <a href="{{ route('admin.orders.show', $order->id) }}" class="btn-primary" style="padding: 5px 10px; text-decoration: none; font-size: 12px;">View</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center;">No orders found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    
    <div style="margin-top: 20px;">
        {{ $orders->links('pagination::simple-bootstrap-5') }}
    </div>
</div>
@endsection
