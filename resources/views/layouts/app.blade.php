<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evara - @yield('title', 'Home')</title>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/profile.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/auth.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @stack('styles')
</head>
<body>

    <!-- Offer Bar -->
    <h3>FREE SHIPPING on Orders above Rs. 2999/-</h3>

    @include('partials.header')

    <main>
        @if(session('success'))
            <div class="alert alert-success" style="padding: 10px; background: #d4edda; color: #155724; text-align: center;">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger" style="padding: 10px; background: #f8d7da; color: #721c24; text-align: center;">
                {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </main>

    @include('partials.footer')

    <script src="{{ asset('assets/js/javascript.js') }}"></script>
    @stack('scripts')
</body>
</html>
