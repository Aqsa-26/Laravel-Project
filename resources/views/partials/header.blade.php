<div id="navbar">
    <!-- Logo -->
    <a href="{{ route('home') }}">
        <img src="{{ asset('assets/images/logo 1.png') }}" alt="Evara Logo" class="logo">
    </a>

    <!-- Menu Links -->
    <div class="menu">
        <!-- Stationery Dropdown -->
        <nav class="navbar">
            <ul>
                <li class="dropdown">
                    <a href="#"><span>✏️</span> Stationery</a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('category.show', 'pen-and-pencils') }}">Pen and Pencils</a></li>
                        <li><a href="{{ route('category.show', 'paints-and-colors') }}">Paints and Colors</a></li>
                        <li><a href="{{ route('category.show', 'markers-and-highlighters') }}">Markers and Highlighters</a></li>
                        <li><a href="{{ route('category.show', 'notebooks-and-diaries') }}">Notebooks and Diaries</a></li>
                        <li><a href="{{ route('category.show', 'cutters-and-staplers') }}">Cutters and Staplers</a></li>
                        <li><a href="{{ route('category.show', 'pouches-and-storage') }}">Pouches and Storage</a></li>
                    </ul>
                </li>
            </ul>
        </nav>

        <!-- Bag Bliss Dropdown -->
        <nav class="navbar">
            <ul>
                <li class="dropdown">
                    <a href="#">👜 Bag Bliss</a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('category.show', 'tote-bags') }}">Tote Bags</a></li>
                        <li><a href="{{ route('category.show', 'shoulder-bags') }}">Shoulder Bags</a></li>
                    </ul>
                </li>
            </ul>
        </nav>

        <!-- Elite Bottle Dropdown -->
        <nav class="navbar">
            <ul>
                <li class="dropdown">
                    <a href="#"><span>✨</span> Elite Bottles</a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('category.show', 'water-bottles') }}">Water Bottles</a></li>
                        <li><a href="{{ route('category.show', 'tumblers') }}">Tumblers</a></li>
                    </ul>
                </li>
            </ul>
        </nav>

        <a href="{{ route('new-arrivals') }}"><span>🆕</span> New Arrivals</a>
       
    </div>

    <!-- Icons with Search Bar -->
    <div class="icons">
        <!-- Search Form -->
        <div class="search-container">
            <form method="GET" action="{{ route('search') }}" class="search-form">
                <input type="text" name="q" placeholder="Search products..." class="search-input" autocomplete="off" value="{{ request('q') }}">
                <button type="submit" class="search-btn">🔍</button>
            </form>
        </div>


        <!-- Profile Dropdown -->
        <div class="dropdown profile-dropdown">
            <a href="#" class="profile-icon">
                <i class="fas fa-user"></i>
            </a>
            <ul class="dropdown-menu profile-menu">
                @auth
                    @if(auth()->user()->isAdmin())
                        <li><a href="{{ route('admin.dashboard') }}">Admin Panel</a></li>
                    @else
                        <li><a href="{{ route('orders.index') }}">My Orders</a></li>
                    @endif
                    <!-- Logged In - Show Logout -->
                    <li>
                        <form action="{{ route('logout') }}" method="POST" id="logout-form">
                            @csrf
                            <button type="submit" style="background:none;border:none;cursor:pointer;width:100%;text-align:left;">Logout</button>
                        </form>
                    </li>
                @else
                    <!-- Logged Out - Show Login -->
                    <li><a href="{{ route('login') }}">Login</a></li>
                    <li><a href="{{ route('register') }}">Register</a></li>
                @endauth
            </ul>
        </div>

        <a href="{{ route('cart.index') }}" title="Cart">🛒 @if(session('cart'))({{ count(session('cart')) }})@endif</a>
    </div>
</div>
