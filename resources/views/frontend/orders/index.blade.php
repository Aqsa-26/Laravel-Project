@extends('layouts.app')

@section('content')
<div style="padding: 50px 0; max-width: 1000px; margin: 0 auto;">
    <h1 style="text-align: center; margin-bottom: 30px; font-family: serif; color: #4f3862;">My Orders</h1>

    @forelse($orders as $order)
        <div style="background: white; border: 1px solid #ddd; border-radius: 10px; margin-bottom: 20px; overflow: hidden;">
            <div style="background: #f8f9fa; padding: 15px 20px; border-bottom: 1px solid #ddd; display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <span style="font-weight: bold; color: #4f3862;">Order #{{ $order->id }}</span>
                    <span style="margin: 0 10px; color: #999;">|</span>
                    <span style="color: #666;">{{ $order->created_at->format('M d, Y') }}</span>
                </div>
                <div>
                    @php
                        $statusColor = match($order->status) {
                            'pending' => '#ff9800', // Orange
                            'processing' => '#2196f3', // Blue
                            'completed' => '#4caf50', // Green
                            'cancelled' => '#f44336', // Red
                            default => '#666'
                        };
                    @endphp
                    <span style="background: {{ $statusColor }}20; color: {{ $statusColor }}; padding: 5px 12px; border-radius: 20px; font-weight: bold; font-size: 14px;">
                        {{ ucfirst($order->status) }}
                    </span>
                </div>
            </div>
            
            <div style="padding: 20px;">
                <table style="width: 100%; margin-bottom: 20px;">
                    @foreach($order->items as $item)
                        <tr style="border-bottom: 1px solid #eee;">
                            <td style="padding: 10px 0;">
                                <div style="display: flex; align-items: center; gap: 15px;">
                                    @if($item->product && $item->product->image)
                                        <img src="{{ asset($item->product->image) }}" alt="{{ $item->product->name }}" style="width: 60px; height: 60px; object-fit: cover; border-radius: 5px;">
                                    @else
                                        <div style="width: 60px; height: 60px; background: #eee; border-radius: 5px;"></div>
                                    @endif
                                    <div>
                                        <h4 style="margin: 0; font-size: 16px;">{{ $item->product->name ?? 'Unknown Product' }}</h4>
                                        <small style="color: #666;">Qty: {{ $item->quantity }}</small>
                                    </div>
                                </div>
                            </td>
                            <td style="text-align: right; font-weight: bold;">
                                Rs. {{ number_format($item->price * $item->quantity, 2) }}
                            </td>
                        </tr>
                    @endforeach
                </table>
                
                <div style="text-align: right; font-size: 18px; font-weight: bold; color: #333;">
                    Total: <span style="color: #4f3862;">Rs. {{ number_format($order->total_price, 2) }}</span>
                </div>
            </div>
        </div>
    @empty
        <div style="text-align: center; padding: 50px;">
            <h3>You haven't placed any orders yet.</h3>
            <a href="{{ route('home') }}" style="display: inline-block; margin-top: 20px; text-decoration: none; color: white; background: #e91e63; padding: 10px 20px; border-radius: 5px;">Start Shopping</a>
        </div>
    @endforelse
</div>
@endsection
