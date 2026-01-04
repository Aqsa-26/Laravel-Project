@extends('layouts.admin')

@section('content')
<div class="header-actions" style="margin-bottom: 25px;">
    <h1>Analytical Reports</h1>
    <span style="color: #666; font-size: 14px;">Snapshot of store performance</span>
</div>

<!-- Key Metrics Grid -->
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 20px; margin-bottom: 30px;">
    
    <!-- Revenue Card -->
    <div style="background: white; padding: 25px; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); border-left: 5px solid #4CAF50;">
        <h4 style="margin: 0 0 10px 0; color: #666; font-size: 14px; text-transform: uppercase;">Total Revenue</h4>
        <div style="font-size: 28px; font-weight: bold; color: #333;">
            Rs. {{ number_format($totalRevenue, 2) }}
        </div>
        <p style="margin: 5px 0 0; font-size: 12px; color: #888;">Completed orders only</p>
    </div>

    <!-- Orders Card -->
    <div style="background: white; padding: 25px; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); border-left: 5px solid #2196F3;">
        <h4 style="margin: 0 0 10px 0; color: #666; font-size: 14px; text-transform: uppercase;">Total Orders</h4>
        <div style="display: flex; align-items: baseline; gap: 10px;">
            <span style="font-size: 28px; font-weight: bold; color: #333;">{{ $totalOrders }}</span>
            <span style="font-size: 14px; color: #e91e63;">({{ $pendingOrders }} Pending)</span>
        </div>
        <p style="margin: 5px 0 0; font-size: 12px; color: #888;">All time orders</p>
    </div>

    <!-- Customers Card -->
    <div style="background: white; padding: 25px; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); border-left: 5px solid #FF9800;">
        <h4 style="margin: 0 0 10px 0; color: #666; font-size: 14px; text-transform: uppercase;">Customers</h4>
        <div style="font-size: 28px; font-weight: bold; color: #333;">
            {{ $totalCustomers }}
        </div>
        <p style="margin: 5px 0 0; font-size: 12px; color: #888;">Registered users</p>
    </div>

    <!-- Products Card -->
    <div style="background: white; padding: 25px; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); border-left: 5px solid #9C27B0;">
        <h4 style="margin: 0 0 10px 0; color: #666; font-size: 14px; text-transform: uppercase;">Inventory</h4>
        <div style="display: flex; align-items: baseline; gap: 10px;">
            <span style="font-size: 28px; font-weight: bold; color: #333;">{{ $totalProducts }}</span>
            <span style="font-size: 14px; color: #f44336;">({{ $lowStockProducts }} Low Stock)</span>
        </div>
        <p style="margin: 5px 0 0; font-size: 12px; color: #888;">Active products</p>
    </div>

</div>

<!-- Recent Activity & Charts Placeholder -->
<div style="display: grid; grid-template-columns: 2fr 1fr; gap: 20px;">
    
    <!-- Recent Orders Table -->
    <div class="content-card" style="background: white; padding: 20px; border-radius: 10px; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
        <h3 style="margin-top: 0; margin-bottom: 20px; color: #333; font-size: 18px; border-bottom: 1px solid #eee; padding-bottom: 10px;">
            Recent Orders
        </h3>
        
        <table class="admin-table" style="width: 100%;">
            <thead>
                <tr>
                    <th style="text-align: left;">Order ID</th>
                    <th style="text-align: left;">Customer</th>
                    <th style="text-align: left;">Amount</th>
                    <th style="text-align: left;">Status</th>
                    <th style="text-align: left;">Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentOrders as $order)
                    <tr>
                        <td style="padding: 12px 0; border-bottom: 1px solid #f0f0f0;">#{{ $order->id }}</td>
                        <td style="padding: 12px 0; border-bottom: 1px solid #f0f0f0;">{{ $order->user ? $order->user->name : 'Guest' }}</td>
                        <td style="padding: 12px 0; border-bottom: 1px solid #f0f0f0; font-weight: 500;">
                            Rs. {{ number_format($order->total_price, 2) }}
                        </td>
                        <td style="padding: 12px 0; border-bottom: 1px solid #f0f0f0;">
                            <span style="
                                padding: 4px 8px; 
                                border-radius: 4px; 
                                font-size: 11px; 
                                text-transform: uppercase;
                                font-weight: bold;
                                background: {{ match($order->status) {
                                    'completed' => '#e8f5e9',
                                    'pending' => '#fff3e0',
                                    'cancelled' => '#ffebee',
                                    default => '#f5f5f5'
                                } }};
                                color: {{ match($order->status) {
                                    'completed' => '#2e7d32',
                                    'pending' => '#ef6c00',
                                    'cancelled' => '#c62828',
                                    default => '#616161'
                                } }};
                            ">
                                {{ $order->status }}
                            </span>
                        </td>
                        <td style="padding: 12px 0; border-bottom: 1px solid #f0f0f0; color: #888; font-size: 13px;">
                            {{ $order->created_at->diffForHumans() }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="text-align: center; padding: 20px; color: #999;">No recent orders.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        
        <div style="margin-top: 20px; text-align: center;">
            <a href="{{ route('admin.orders.index') }}" style="color: #e91e63; text-decoration: none; font-size: 14px; font-weight: 500;">View All Orders →</a>
        </div>
    </div>

    <!-- Quick Actions / Notes -->
    <div style="display: flex; flex-direction: column; gap: 20px;">
        <div class="content-card" style="background: white; padding: 20px; border-radius: 10px; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
            <h3 style="margin-top: 0; margin-bottom: 15px; color: #333; font-size: 16px;">Quick Stats</h3>
            <ul style="list-style: none; padding: 0; margin: 0;">
                <li style="display: flex; justify-content: space-between; padding: 10px 0; border-bottom: 1px solid #eee;">
                    <span style="color: #666;">Low Stock Items</span>
                    <span style="font-weight: bold; color: #e91e63;">{{ $lowStockProducts }}</span>
                </li>
                <li style="display: flex; justify-content: space-between; padding: 10px 0; border-bottom: 1px solid #eee;">
                    <span style="color: #666;">Pending Orders</span>
                    <span style="font-weight: bold; color: #FF9800;">{{ $pendingOrders }}</span>
                </li>
                <li style="display: flex; justify-content: space-between; padding: 10px 0; border-bottom: 1px solid #eee;">
                    <span style="color: #666;">Avg. Order Value</span>
                    @php
                        $avgOrder = $totalOrders > 0 ? $totalRevenue / $totalOrders : 0;
                    @endphp
                    <span style="font-weight: bold; color: #333;">Rs. {{ number_format($avgOrder, 0) }}</span>
                </li>
            </ul>
        </div>

        <div class="content-card" style="background: #e3f2fd; padding: 20px; border-radius: 10px;">
            <h3 style="margin-top: 0; margin-bottom: 10px; color: #0d47a1; font-size: 16px;">System Status</h3>
            <p style="margin: 0; font-size: 13px; color: #1e88e5;">
                <span style="display: inline-block; width: 8px; height: 8px; background: #4caf50; border-radius: 50%; margin-right: 5px;"></span>
                System is running smoothly.
            </p>
            <p style="margin-top: 5px; font-size: 13px; color: #666;">
                Last backup: Today, 03:00 AM
            </p>
        </div>
    </div>

</div>
@endsection
