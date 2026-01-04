@extends('layouts.admin')

@section('content')
    <!-- Welcome Section -->
    <section class="admin-welcome">
        <h1 class="welcome-title">Welcome back, {{ Auth::user()->name ?? 'Admin' }}!</h1>
        <p class="welcome-text">Here's what's happening with your Evara store today.</p>
    </section>

    <!-- Stats Cards -->
    <section class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon products">
                <i class="fas fa-box"></i>
            </div>
            <h3 class="stat-number">{{ number_format($productsCount) }}</h3>
            <p class="stat-title">Total Products</p>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon orders">
                <i class="fas fa-shopping-cart"></i>
            </div>
            <h3 class="stat-number">{{ number_format($ordersCount) }}</h3>
            <p class="stat-title">Total Orders</p>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon customers">
                <i class="fas fa-users"></i>
            </div>
            <h3 class="stat-number">{{ number_format($usersCount) }}</h3>
            <p class="stat-title">Total Customers</p>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon revenue">
                <i class="fas fa-chart-line"></i>
            </div>
            <h3 class="stat-number">Rs. {{ number_format($revenue, 2) }}</h3>
            <p class="stat-title">Total Revenue</p>
        </div>
    </section>

    <!-- Recent Orders Section -->
    <section class="content-card">
        <h3 class="card-title">Recent Orders</h3>
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentOrders as $order)
                    <tr>
                        <td>#{{ $order->id }}</td>
                        <td>{{ $order->user->name ?? 'Guest' }}</td>
                        <td>Rs. {{ number_format($order->total_price, 2) }}</td>
                        <td>
                            <span class="badge badge-{{ strtolower($order->status) }}">{{ ucfirst($order->status) }}</span>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('admin.orders.show', $order->id) }}" class="btn-small btn-view">View</a>
                                <a href="{{ route('admin.orders.edit', $order->id) }}" class="btn-small btn-edit">Edit</a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="text-align: center; color: #666;">No orders found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <a href="{{ route('admin.orders.index') }}" class="view-all-link">View All Orders →</a>
    </section>

    <!-- Recent Products Section -->
    <section class="content-card">
        <h3 class="card-title">Recent Products</h3>
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentProducts as $product)
                    <tr>
                        <td>
                            <div style="display: flex; align-items: center; gap: 10px;">
                                @if($product->image)
                                    <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="table-product-img">
                                @endif
                                <span>{{ $product->name }}</span>
                            </div>
                        </td>
                        <td>Rs. {{ number_format($product->price, 2) }}</td>
                        <td>{{ $product->stock }}</td>
                        <td>
                            @if($product->stock > 0)
                                <span class="badge badge-instock">In Stock</span>
                            @else
                                <span class="badge badge-outstock">Out of Stock</span>
                            @endif
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('admin.products.show', $product->id) }}" class="btn-small btn-view">View</a>
                                <a href="{{ route('admin.products.edit', $product->id) }}" class="btn-small btn-edit">Edit</a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="text-align: center; color: #666;">No products found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <a href="{{ route('admin.products.index') }}" class="view-all-link">View All Products →</a>
    </section>
@endsection
