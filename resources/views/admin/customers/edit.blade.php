@extends('layouts.admin')

@section('content')
<div class="header-actions" style="margin-bottom: 20px; display: flex; justify-content: space-between;">
    <h1>Edit Customer</h1>
    <a href="{{ route('admin.customers.index') }}" class="btn-primary" style="background: gray; text-decoration: none;">Back to List</a>
</div>

<div class="content-card" style="max-width: 600px; margin: 0 auto;">
    <form action="{{ route('admin.customers.update', $customer->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" id="name" class="form-select" value="{{ $customer->name }}" required>
        </div>

        <div class="form-group">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-select" value="{{ $customer->email }}" required>
        </div>

        <button type="submit" class="btn-primary" style="width: 100%; background: #e91e63;">Update Customer</button>
    </form>
</div>
@endsection
