@extends('layouts.admin')

@section('content')
<div class="header-actions" style="margin-bottom: 20px;">
    <h1>Customers</h1>
</div>

<div class="content-card">
    <table class="admin-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Joined Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($customers as $customer)
                <tr>
                    <td>{{ $customer->id }}</td>
                    <td>{{ $customer->name }}</td>
                    <td>{{ $customer->email }}</td>
                    <td>{{ $customer->created_at->format('M d, Y') }}</td>
                    <td>
                         <a href="{{ route('admin.customers.edit', $customer->id) }}" class="btn-small btn-edit" style="text-decoration:none;">Edit</a>
                         <a href="{{ route('admin.customers.show', $customer->id) }}" class="btn-small btn-view" style="text-decoration:none;">View</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align: center;">No customers found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    
    <div style="margin-top: 20px;">
        {{ $customers->links() }}
    </div>
</div>
@endsection
