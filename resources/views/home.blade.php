@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <!-- Banner Section - Clean Swiper Slider -->
    <section class="banner">
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                
                <!-- Slide 1 -->
                <div class="swiper-slide">
                    <img src="{{ asset('assets/images/cry.jpg') }}" alt="Fresh Arrivals">
                    <div class="slide1-text">
                        <h1>Fresh Arrivals</h1>
                        <p>Discover new collections now!</p>
                    </div>
                    <div class="logo-overlay">
                        <img src="{{ asset('assets/images/logo 1.png') }}" alt="Logo">
                    </div>
                </div>

                <!-- Slide 2 -->
                <div class="swiper-slide">
                    <img src="{{ asset('assets/images/diarybg.jpg') }}" alt="Diary">
                    <div class="slide2-text">
                        <h1>Write, Draw, Dream</h1>
                        <p>We've Got You Covered</p>
                    </div>
                    <div class="logo-overlay">
                        <img src="{{ asset('assets/images/logo 1.png') }}" alt="Logo">
                    </div>
                </div>

                <!-- Slide 3 -->
                <div class="swiper-slide">
                    <img src="{{ asset('assets/images/colors.jpg') }}" alt="Colors">
                    <div class="slide3-text">
                        <h1>Your Go-To Bag</h1>
                        <p>Just a click away...</p>
                    </div>
                    <div class="logo-overlay">
                        <img src="{{ asset('assets/images/logo 1.png') }}" alt="Logo">
                    </div>
                </div>
                
                <!-- Slide 4 -->
                <div class="swiper-slide">
                    <img src="{{ asset('assets/images/BLUE (2).png') }}" alt="Stationery">
                    <div class="slide4-text">
                        <h1>Where Ideas Meet Quality Stationery</h1>
                        <p>Shop Now</p>
                    </div>
                    <div class="logo-overlay">
                        <img src="{{ asset('assets/images/logo 1.png') }}" alt="Logo">
                    </div>
                </div>

                <!-- Slide 5 -->
                <div class="swiper-slide">
                    <img src="{{ asset('assets/images/pasd.png') }}" alt="Paper">
                    <div class="slide5-text">
                        <h1>For the Love of Paper</h1>
                        <p>Pens, and Possibilities.</p>
                    </div>
                    <div class="logo-overlay">
                        <img src="{{ asset('assets/images/logo 1.png') }}" alt="Logo">
                    </div>
                </div>
            </div>

            <!-- Pagination & Navigation -->
            <div class="swiper-pagination"></div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </section>

    <!-- Featured Picks Section -->
    <section class="picks-section">
        <div class="picks-section">
            <div class="picks-grid">
                <a href="{{ route('new-arrivals') }}" class="pick-box pink">
                    <img src="{{ asset('assets/images/Aug .webp') }}" alt="August">
                </a>

                <a href="{{ route('category.show', 'notebooks-and-diaries') }}" class="pick-box">
                    <img src="{{ asset('assets/images/Notebooks.webp') }}" alt="Notebook">
                </a>

                <a href="{{ route('category.show', 'pouches-and-storage') }}" class="pick-box">
                    <img src="{{ asset('assets/images/pouch.webp') }}" alt="Pouch">
                </a>

                <a href="{{ route('category.show', 'water-bottles') }}" class="pick-box">
                    <img src="{{ asset('assets/images/WB.webp') }}" alt="Water Bottle">
                </a>
            </div>

            <!-- Bottom row -->
            <div class="boxes-container">
                <div class="bottom-row">
                    <a href="{{ route('category.show', 'pen-and-pencils') }}" class="pens-box">
                        <h2>Pens Collection</h2>
                    </a>

                    <a href="{{ route('category.show', 'sale') }}" class="deal-box">
                        <h2>DEALS</h2>
                        <h4>Upto 40% off</h4>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Deals and Bundles Section -->
    <section class="deals-section">
        <h2 class="section-title">DEALS AND BUNDLES</h2>
        <div class="product-grid">
        <div class="product-grid">
            @forelse($deals as $product)
                <div class="product-card">
                    <a href="{{ route('product.show', $product->id) }}" style="text-decoration: none; color: inherit;">
                        <img src="{{ asset($product->image) }}" alt="{{ $product->name }}">
                        <h3>{{ $product->name }}</h3>
                        <div class="rating">
                            @for($i=1; $i<=5; $i++)
                                <span class="star">★</span>
                            @endfor
                            <span>(5)</span>
                        </div>
                        <p class="price">Rs.{{ number_format($product->price, 2) }} PKR</p>
                    </a>
                </div>
            @empty
                <p>No deals available at the moment.</p>
            @endforelse
        </div>

        <div class="show-more-container">
            <a href="{{ route('category.show', 'sale') }}" class="show-more-btn">Show More</a>
        </div>
    </section>

    <!-- Tote & Shoulder Bags Section -->
    <section class="bags-section">
        <h2 class="section-title">TOTE & SHOULDER BAGS</h2>
        <div class="product-grid">
            @forelse($bags as $product)
                <div class="product-card">
                    <a href="{{ route('product.show', $product->id) }}" style="text-decoration: none; color: inherit;">
                        <img src="{{ asset($product->image) }}" alt="{{ $product->name }}">
                        <h3>{{ $product->name }}</h3>
                        <div class="rating">
                            @for($i=1; $i<=5; $i++)
                                <span class="star">★</span>
                            @endfor
                            <span>(5)</span>
                        </div>
                        <p class="price">Rs.{{ number_format($product->price, 2) }} PKR</p>
                    </a>
                </div>
            @empty
                <p>No bags available.</p>
            @endforelse
        </div>

        <div class="show-more-container">
            <a href="{{ route('category.show', 'tote-bags') }}" class="show-more-btn">Show More</a>
        </div>
    </section>

    <!-- Mini Fans Section -->
    <section class="fans-section">
        <h2 class="section-title">MINI FANS</h2>
        <div class="product-grid">
            @forelse($fans as $product)
                <div class="product-card">
                    <a href="{{ route('product.show', $product->id) }}" style="text-decoration: none; color: inherit;">
                        <img src="{{ asset($product->image) }}" alt="{{ $product->name }}">
                        <h3>{{ $product->name }}</h3>
                        <div class="rating">
                            @for($i=1; $i<=5; $i++)
                                <span class="star">★</span>
                            @endfor
                            <span>(5)</span>
                        </div>
                        <p class="price">Rs.{{ number_format($product->price, 2) }} PKR</p>
                    </a>
                </div>
            @empty
                <p>No fans available.</p>
            @endforelse
        </div>

        <div class="show-more-container">
            <a href="{{ route('category.show', 'fans') }}" class="show-more-btn">✨ Show More</a>
        </div>
    </section>

    <!-- Stationery Section -->
    <section class="stationery-section">
        <h2 class="section-title">STATIONERY</h2>
        <div class="product-grid">
            @forelse($stationery as $product)
                <div class="product-card">
                    <a href="{{ route('product.show', $product->id) }}" style="text-decoration: none; color: inherit;">
                        <img src="{{ asset($product->image) }}" alt="{{ $product->name }}">
                        <h3>{{ $product->name }}</h3>
                        <div class="rating">
                            @for($i=1; $i<=5; $i++)
                                <span class="star">★</span>
                            @endfor
                            <span>(5)</span>
                        </div>
                        <p class="price">Rs.{{ number_format($product->price, 2) }} PKR</p>
                    </a>
                </div>
            @empty
                <p>No stationery available.</p>
            @endforelse
        </div>

        <div class="show-more-container">
            <a href="{{ route('category.show', 'pen-and-pencils') }}" class="show-more-btn">Show More</a>
        </div>
    </section>

    <!-- Our Collection Section -->
    <section class="collection-section">
        <h2 class="section-title">OUR COLLECTION</h2>
        <div class="product-grid">
            <!-- Collection 1 -->
            <div class="product-card">
                <a href="{{ route('category.show', 'pen-and-pencils') }}">
                    <img src="{{ asset('assets/images/pen and p OC.jpg') }}" alt="Stationery Collection">
                    <h3>Pen and Pencils</h3>
                </a>
            </div>

            <!-- Collection 2 -->
            <div class="product-card">
                <a href="{{ route('category.show', 'markers-and-highlighters') }}">
                    <img src="{{ asset('assets/images/markers.webp') }}" alt="Markers Collection">
                    <h3>Markers</h3>
                </a>
            </div>

            <!-- Collection 3 -->
            <div class="product-card">
                <a href="{{ route('category.show', 'notebooks-and-diaries') }}">
                    <img src="{{ asset('assets/images/Notebooks and Diaries.webp') }}" alt="Notebooks Collection">
                    <h3>Notebook and Diaries</h3>
                </a>
            </div>

            <!-- Collection 4 -->
            <div class="product-card">
                <a href="{{ route('category.show', 'tote-bags') }}">
                    <img src="{{ asset('assets/images/Bag a P OC.webp') }}" alt="Bags Collection">
                    <h3>Bags and Pouches</h3>
                </a>
            </div>

            <!-- Collection 5 -->
            <div class="product-card">
                <a href="{{ route('category.show', 'water-bottles') }}">
                    <img src="{{ asset('assets/images/Water B OC.webp') }}" alt="Bottles Collection">
                    <h3>Bottles</h3>
                </a>
            </div>

            <!-- Collection 6 -->
            <div class="product-card">
                <a href="{{ route('category.show', 'fans') }}">
                    <img src="{{ asset('assets/images/Fans OC.webp') }}" alt="Fans Collection">
                    <h3>Portable Mini Fans</h3>
                </a>
            </div>

            <!-- Collection 7 -->
            <div class="product-card">
                <a href="{{ route('category.show', 'cutters-and-staplers') }}">
                    <img src="{{ asset('assets/images/cutters OC.webp') }}" alt="Cutters Collection">
                    <h3>Cutters and Staplers</h3>
                </a>
            </div>

            <!-- Collection 8 -->
            <div class="product-card">
                <a href="{{ route('category.show', 'paints-and-colors') }}">
                    <img src="{{ asset('assets/images/Stationary/PAINT S3.avif') }}" alt="Gift Collection">
                    <h3>Paint Items</h3>
                </a>
            </div>
        </div>
    </section>
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const swiper = new Swiper('.mySwiper', {
                loop: true,
                speed: 800,
                slidesPerView: 1,
                spaceBetween: 0,
                autoplay: {
                    delay: 4000,
                    disableOnInteraction: false,
                    pauseOnMouseEnter: true,
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                    dynamicBullets: true,
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                effect: 'fade',
                fadeEffect: {
                    crossFade: true
                },
                keyboard: {
                    enabled: true,
                }
            });
            
            const slider = document.querySelector('.mySwiper');
            if(slider) {
                slider.addEventListener('mouseenter', function() {
                    swiper.autoplay.stop();
                });
                
                slider.addEventListener('mouseleave', function() {
                    swiper.autoplay.start();
                });
            }
        });
    </script>
@endpush
