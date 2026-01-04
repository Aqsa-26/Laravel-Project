@extends('layouts.admin')

@section('content')
<div class="header-actions" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
    <h1>Categories</h1>
    <a href="{{ route('admin.categories.create') }}" class="btn-primary" style="background: #e91e63; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;">Add New Category</a>
</div>

<div class="content-card">
    <table class="admin-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Slug</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->slug }}</td>
                    <td>
                        <a href="{{ route('admin.categories.edit', $category->id) }}" style="color: blue; text-decoration: none;">Edit</a> | 
                        <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this category?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="background:none; border:none; padding:0; color:red; cursor:pointer;">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" style="text-align: center;">No categories found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
