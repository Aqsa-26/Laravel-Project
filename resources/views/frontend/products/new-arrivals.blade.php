@extends('layouts.app')

@section('content')
<div class="container" style="padding: 20px;">
    <h1>New Arrivals</h1>
    <div class="product-grid">
        @forelse($products as $product)
            <div class="product-card">
                <a href="{{ route('product.show', $product->id) }}">
                    <img src="{{ asset($product->image) }}" alt="{{ $product->name }}">
                    <h3>{{ $product->name }}</h3>
                </a>
                <p class="price">Rs. {{ number_format($product->price, 2) }}</p>
            </div>
        @empty
            <p>No new arrivals yet.</p>
        @endforelse
    </div>
</div>
@endsection
