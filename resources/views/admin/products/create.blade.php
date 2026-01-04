@extends('layouts.admin')

@section('content')
<div class="header-actions" style="margin-bottom: 20px;">
    <h1>Create Product</h1>
</div>

<div class="content-card" style="background: white; padding: 20px; border-radius: 8px;">
    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="form-group" style="margin-bottom: 15px;">
            <label>Name</label>
            <input type="text" name="name" class="form-control" required style="width: 100%; padding: 8px;">
        </div>

        <div class="form-group" style="margin-bottom: 15px;">
            <label>Category</label>
            <select name="category_id" class="form-control" required style="width: 100%; padding: 8px;">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group" style="margin-bottom: 15px;">
            <label>Price (Rs.)</label>
            <input type="number" name="price" step="0.01" class="form-control" required style="width: 100%; padding: 8px;">
        </div>

        <div class="form-group" style="margin-bottom: 15px;">
            <label>Stock</label>
            <input type="number" name="stock" class="form-control" value="10" required style="width: 100%; padding: 8px;">
        </div>

        <div class="form-group" style="margin-bottom: 15px;">
            <label>Description</label>
            <textarea name="description" class="form-control" rows="4" style="width: 100%; padding: 8px;"></textarea>
        </div>

        <div class="form-group" style="margin-bottom: 15px;">
            <label>Image</label>
            <input type="file" name="image" class="form-control">
        </div>

        <button type="submit" class="btn-primary" style="background: #e91e63; color: white; padding: 10px 20px; border: none; cursor: pointer;">Create Product</button>
    </form>
</div>
@endsection
