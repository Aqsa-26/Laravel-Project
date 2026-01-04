@extends('layouts.app')

@section('content')
<div class="container" style="padding: 20px; max-width: 800px; margin: 0 auto;">
    <h1>Shopping Cart</h1>
    
    @if(session('cart') && count(session('cart')) > 0)
        <table class="cart-table" style="width: 100%; border-collapse: collapse; margin-top: 20px;">
            <thead>
                <tr style="border-bottom: 2px solid #eee;">
                    <th style="padding: 10px; text-align: left;">Product</th>
                    <th style="padding: 10px; text-align: center;">Price</th>
                    <th style="padding: 10px; text-align: center;">Quantity</th>
                    <th style="padding: 10px; text-align: right;">Subtotal</th>
                    <th style="padding: 10px; text-align: center;">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach(session('cart') as $id => $details)
                    <tr style="border-bottom: 1px solid #eee;">
                        <td style="padding: 10px;">
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <img src="{{ asset($details['image']) }}" width="50" height="50" style="object-fit: cover;">
                                <span>{{ $details['name'] }}</span>
                            </div>
                        </td>
                        <td style="padding: 10px; text-align: center;">Rs. {{ number_format($details['price'], 2) }}</td>
                        <td style="padding: 10px; text-align: center;">{{ $details['quantity'] }}</td>
                        <td style="padding: 10px; text-align: right;">Rs. {{ number_format($details['price'] * $details['quantity'], 2) }}</td>
                        <td style="padding: 10px; text-align: center;">
                            <form action="{{ route('cart.remove') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $id }}">
                                <button type="submit" style="color: red; background: none; border: none; cursor: pointer;">remove</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" style="text-align: right; padding: 20px; font-weight: bold;">Total:</td>
                    <td style="text-align: right; padding: 20px; font-weight: bold;">Rs. {{ number_format($total, 2) }}</td>
                    <td></td>
                </tr>
            </tfoot>
        </table>
        
        <div style="margin-top: 30px; text-align: right;">
            <a href="{{ route('home') }}" style="text-decoration: none; color: #666; margin-right: 20px;">Continue Shopping</a>
            <a href="{{ route('checkout.index') }}" style="background: #e91e63; color: white; padding: 10px 30px; text-decoration: none; border-radius: 5px;">Checkout</a>
        </div>
    @else
        <div style="text-align: center; padding: 50px;">
            <p>Your cart is empty.</p>
            <a href="{{ route('home') }}" class="btn-primary">Go Shopping</a>
        </div>
    @endif
</div>
@endsection
