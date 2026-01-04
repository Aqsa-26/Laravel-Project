@extends('layouts.admin')

@section('content')
<div class="header-actions" style="margin-bottom: 20px;">
    <h1>Edit Product: {{ $product->name }}</h1>
</div>

<div class="content-card" style="background: white; padding: 20px; border-radius: 8px;">
    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="form-group" style="margin-bottom: 15px;">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ $product->name }}" required style="width: 100%; padding: 8px;">
        </div>

        <div class="form-group" style="margin-bottom: 15px;">
            <label>Category</label>
            <select name="category_id" class="form-control" required style="width: 100%; padding: 8px;">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group" style="margin-bottom: 15px;">
            <label>Price (Rs.)</label>
            <input type="number" name="price" step="0.01" class="form-control" value="{{ $product->price }}" required style="width: 100%; padding: 8px;">
        </div>

        <div class="form-group" style="margin-bottom: 15px;">
            <label>Stock</label>
            <input type="number" name="stock" class="form-control" value="{{ $product->stock }}" required style="width: 100%; padding: 8px;">
        </div>

        <div class="form-group" style="margin-bottom: 15px;">
            <label>Description</label>
            <textarea name="description" class="form-control" rows="4" style="width: 100%; padding: 8px;">{{ $product->description }}</textarea>
        </div>

        <div class="form-group" style="margin-bottom: 15px;">
            <label>Current Image</label>
            @if($product->image)
                <div style="margin-bottom: 10px;">
                    <img src="{{ asset($product->image) }}" width="100">
                </div>
            @endif
            <label>New Image (optional)</label>
            <input type="file" name="image" class="form-control">
        </div>

        <button type="submit" class="btn-primary" style="background: #e91e63; color: white; padding: 10px 20px; border: none; cursor: pointer;">Update Product</button>
    </form>
</div>
@endsection
