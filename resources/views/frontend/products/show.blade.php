@extends('layouts.app')

@section('content')
<div class="product-detail-container" style="padding: 40px; display: flex; gap: 40px; max-width: 1200px; margin: 0 auto;">
    <div class="product-image" style="flex: 1;">
        <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" style="width: 100%; border-radius: 10px;">
    </div>
    <div class="product-info" style="flex: 1;">
        <h1>{{ $product->name }}</h1>
        <p class="price" style="font-size: 24px; color: #e91e63; font-weight: bold;">Rs. {{ number_format($product->price, 2) }}</p>
        <p class="description">{{ $product->description }}</p>
        
        <form action="{{ route('cart.add') }}" method="POST" style="margin-top: 20px;">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            
            @if($product->stock > 0)
                <div class="form-group">
                    <label for="quantity">Quantity:</label>
                    <input type="number" name="quantity" id="quantity" value="1" min="1" max="{{ $product->stock }}" style="padding: 5px; margin-right: 10px;">
                    <button type="submit" class="btn-add-cart" style="background: #e91e63; color: white; padding: 10px 20px; border: none; cursor: pointer;">Add to Cart</button>
                    <p style="margin-top: 10px; color: green; font-size: 14px;">In Stock: {{ $product->stock }} available</p>
                </div>
            @else
                <div style="margin-top: 20px;">
                    <button type="button" disabled style="background: #ccc; color: white; padding: 10px 20px; border: none; cursor: not-allowed;">Out of Stock</button>
                </div>
            @endif
        </form>
    </div>
</div>
@endsection
