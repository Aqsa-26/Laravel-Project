<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Evara Admin</title>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Admin CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}">
</head>
<body class="admin-dashboard">
    <!-- Admin Header -->
    <header class="admin-header">
        <div class="admin-brand">
            <img src="{{ asset('assets/images/logo 1.png') }}" alt="Evara Logo" class="logo">
            <h2>Evara Admin</h2>
        </div>
        
        <div class="admin-user">
            <!-- Auth Name -->
            <span>Welcome, {{ Auth::user()->name ?? 'Admin' }}</span>
            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="btn-logout" style="background:none; border:none; color:inherit; cursor:pointer;">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </form>
        </div>
    </header>

    <div class="admin-container">
        <!-- Sidebar -->
        <nav class="admin-sidebar">
            <ul class="sidebar-nav">
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="{{ Route::is('admin.dashboard') ? 'active' : '' }}">
                        <i class="fas fa-tachometer-alt"></i> Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.products.index') }}" class="{{ Route::is('admin.products.*') ? 'active' : '' }}">
                        <i class="fas fa-box"></i> Products
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.categories.index') }}" class="{{ Route::is('admin.categories.*') ? 'active' : '' }}">
                        <i class="fas fa-list"></i> Categories
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.orders.index') }}" class="{{ Route::is('admin.orders.*') ? 'active' : '' }}">
                        <i class="fas fa-shopping-cart"></i> Orders
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.customers.index') }}" class="{{ Route::is('admin.customers.*') ? 'active' : '' }}">
                        <i class="fas fa-users"></i> Customers
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.reports.index') }}" class="{{ Route::is('admin.reports.*') ? 'active' : '' }}">
                        <i class="fas fa-chart-bar"></i> Reports
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Main Content -->
        <main class="admin-main">
            @yield('content')
        </main>
    </div>
</body>
</html>
