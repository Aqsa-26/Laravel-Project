@extends('layouts.admin')

@section('content')
<div class="header-actions" style="margin-bottom: 20px; display: flex; justify-content: space-between;">
    <h1>Order #{{ $order->id }}</h1>
    <a href="{{ route('admin.orders.index') }}" class="btn-primary" style="background: gray; text-decoration: none;">Back to List</a>
</div>

<div style="display: flex; gap: 20px;">
    <div class="content-card" style="flex: 2; background: white; padding: 20px; border-radius: 8px;">
        <h3>Items</h3>
        <table class="admin-table" style="width: 100%; text-align: left;">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $item)
                    <tr>
                        <td>{{ $item->product ? $item->product->name : 'Deleted Product' }}</td>
                        <td>Rs. {{ number_format($item->price, 2) }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>Rs. {{ number_format($item->price * $item->quantity, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div style="text-align: right; margin-top: 20px; font-weight: bold; font-size: 18px;">
            Total: Rs. {{ number_format($order->total_price, 2) }}
        </div>
    </div>

    <div class="content-card" style="flex: 1; background: white; padding: 20px; border-radius: 8px;">
        <h3>Order Details</h3>
        <p><strong>Customer:</strong> {{ $order->user ? $order->user->name : 'Guest' }}</p>
        <p><strong>Email:</strong> {{ $order->user ? $order->user->email : 'N/A' }}</p>
        <p><strong>Phone:</strong> {{ $order->phone }}</p>
        <p><strong>Address:</strong><br>{{ $order->shipping_address }}</p>
        <p><strong>Date:</strong> {{ $order->created_at->format('d M Y H:i') }}</p>
        
        <hr style="margin: 20px 0;">
        
        <h3>Status Update</h3>
        <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group" style="margin-bottom: 15px;">
                <select name="status" class="form-control" style="width: 100%; padding: 8px;">
                    <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                    <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>
            <button type="submit" class="btn-primary" style="width: 100%; background: #e91e63;">Update Status</button>
        </form>
    </div>
</div>
@endsection
