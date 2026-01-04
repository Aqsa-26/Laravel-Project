@extends('layouts.admin')

@section('content')
<div class="header-actions" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
    <h1>Products</h1>
    <a href="{{ route('admin.products.create') }}" class="btn-primary" style="background: #e91e63; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;">Add New Product</a>
</div>

<div class="content-card">
    <table class="admin-table">
        <thead>
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $product)
                <tr>
                    <td>
                        @if($product->image)
                            <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" width="50">
                        @else
                            -
                        @endif
                    </td>
                    <td>{{ $product->name }}</td>
                    <td>Rs. {{ number_format($product->price, 2) }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>
                        <a href="{{ route('admin.products.edit', $product->id) }}" style="color: blue; text-decoration: none;">Edit</a> | 
                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="background:none; border:none; padding:0; color:red; cursor:pointer;">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align: center;">No products found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    
    <div style="margin-top: 20px;">
        {{ $products->links('pagination::simple-bootstrap-5') }}
    </div>
</div>
@endsection
