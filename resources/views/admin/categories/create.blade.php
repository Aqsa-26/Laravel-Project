@extends('layouts.admin')

@section('content')
<div class="header-actions" style="margin-bottom: 20px;">
    <h1>Create Category</h1>
</div>

<div class="content-card">
    <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name" class="form-label">Category Name</label>
            <input type="text" name="name" id="name" class="form-select" required style="width: 100%; height: 40px;">
        </div>
        
        <div class="form-group">
            <label for="slug" class="form-label">Slug</label>
            <input type="text" name="slug" id="slug" class="form-select" required style="width: 100%; height: 40px;">
            <small style="color: grey;">The "slug" is the URL-friendly version of the name. It is usually all lowercase and contains only letters, numbers, and hyphens.</small>
        </div>

        <button type="submit" class="btn btn-primary">Create Category</button>
    </form>
</div>
@endsection
