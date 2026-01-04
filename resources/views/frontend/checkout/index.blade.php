@extends('layouts.app')

@section('content')
<div class="container" style="padding: 20px; max-width: 600px; margin: 0 auto;">
    <h1>Checkout</h1>
    
    <div style="background: #f9f9f9; padding: 20px; border-radius: 10px; margin-top: 20px;">
        <h3>Shipping Details</h3>
        <form action="{{ route('checkout.process') }}" method="POST">
            @csrf
            
            <div class="form-group" style="margin-bottom: 15px;">
                <label>Full Name</label>
                <input type="text" name="name" class="form-control" required style="width: 100%; padding: 8px;">
            </div>
            
            <div class="form-group" style="margin-bottom: 15px;">
                <label>Address</label>
                <textarea name="shipping_address" class="form-control" required style="width: 100%; padding: 8px;"></textarea>
            </div>
            
            <div class="form-group" style="margin-bottom: 15px;">
                <label>Phone</label>
                <input type="text" name="phone" class="form-control" required style="width: 100%; padding: 8px;">
            </div>
            
            <div style="border-top: 1px solid #ddd; padding-top: 20px; margin-top: 20px;">
                <button type="submit" style="background: #e91e63; color: white; padding: 12px 0; width: 100%; border: none; cursor: pointer; font-size: 16px;">Place Order</button>
            </div>
        </form>
    </div>
</div>
@endsection
