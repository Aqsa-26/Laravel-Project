@extends('layouts.admin')

@section('content')
<div class="header-actions" style="display: flex; justify-content: space-between; margin-bottom: 20px;">
    <h1>Customer Details</h1>
    <a href="{{ route('admin.customers.index') }}" class="btn-primary" style="background: gray; text-decoration: none;">Back to List</a>
</div>

<div class="content-card">
    <div style="margin-bottom: 30px;">
        <h3>Profile Info</h3>
        <p><strong>Name:</strong> {{ $customer->name }}</p>
        <p><strong>Email:</strong> {{ $customer->email }}</p>
        <p><strong>Joined:</strong> {{ $customer->created_at->format('M d, Y') }}</p>
    </div>

    <h3>Order History</h3>
    <table class="admin-table">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Date</th>
                <th>Total</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($customer->orders as $order)
                <tr>
                    <td>#{{ $order->id }}</td>
                    <td>{{ $order->created_at->format('M d, Y') }}</td>
                    <td>Rs. {{ number_format($order->total_price, 2) }}</td>
                    <td>{{ ucfirst($order->status) }}</td>
                    <td>
                        <a href="{{ route('admin.orders.show', $order->id) }}" class="btn-small btn-view">View Order</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align: center;">No orders found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
