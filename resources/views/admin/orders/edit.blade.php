@extends('layouts.admin')

@section('content')
<div class="header-actions" style="margin-bottom: 20px; display: flex; justify-content: space-between;">
    <h1>Edit Order #{{ $order->id }}</h1>
    <a href="{{ route('admin.orders.index') }}" class="btn-primary" style="background: gray; text-decoration: none;">Back to List</a>
</div>

<div class="content-card" style="background: white; padding: 20px; border-radius: 8px; max-width: 600px; margin: 0 auto;">
    <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group" style="margin-bottom: 15px;">
            <label class="form-label">Customer Name</label>
            <input type="text" class="form-select" value="{{ $order->user ? $order->user->name : 'Guest' }}" disabled style="background: #f0f0f0;">
        </div>

        <div class="form-group" style="margin-bottom: 15px;">
            <label class="form-label">Status</label>
            <select name="status" class="form-select">
                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>
        </div>

        <!-- Add more editable fields if required, like shipping address -->
        <div class="form-group" style="margin-bottom: 15px;">
            <label class="form-label">Shipping Address</label>
            <textarea name="shipping_address" class="form-textarea" required>{{ $order->shipping_address }}</textarea>
        </div>
        
        <div class="form-group" style="margin-bottom: 15px;">
            <label class="form-label">Phone</label>
            <input type="text" name="phone" class="form-select" value="{{ $order->phone }}" required>
        </div>

        <button type="submit" class="btn-primary" style="width: 100%; background: #e91e63;">Update Order</button>
    </form>
</div>
@endsection
