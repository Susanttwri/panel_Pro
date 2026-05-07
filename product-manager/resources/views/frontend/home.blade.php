@extends('layouts.frontend')

@section('title', 'PanelsPro - Premium Products')
@section('meta_description', 'Discover premium tech products at PanelsPro. Shop the best gadgets, accessories, and electronics.')

@section('content')
    <!-- Hero Section -->
    <section class="hero" style="display:flex; flex-wrap:wrap; align-items:center; justify-content:center; gap:60px;">
        <div class="hero-content" style="flex:1; min-width:300px; max-width:500px; text-align:left;">
            <div class="hero-badge">
                <i class="fas fa-sparkles"></i>
                New Collection Available
            </div>
            <h1 style="text-align:left;">Premium Products,<br>Curated For You</h1>
            <p style="text-align:left;">Discover our handpicked selection of premium tech gadgets and accessories. Quality meets innovation in every product we offer.</p>
            <div class="hero-buttons" style="justify-content:flex-start;">
                <a href="{{ route('products') }}" class="btn-hero btn-hero-primary">
                    <i class="fas fa-store"></i> Browse Products
                </a>
                <a href="#featured" class="btn-hero btn-hero-outline">
                    <i class="fas fa-arrow-down"></i> See Featured
                </a>
            </div>
        </div>
        
        <!-- Interactive Anime Mascot -->
        <div class="hero-anime-container" style="position:relative; width:300px; height:300px; cursor:pointer;" onclick="this.querySelector('.anime-mascot').classList.toggle('spin')">
            <style>
                .anime-mascot {
                    width: 200px; height: 200px; background: #111827; border-radius: 40% 40% 50% 50%;
                    position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);
                    box-shadow: 0 20px 40px rgba(17,24,39,0.3);
                    animation: float 4s ease-in-out infinite;
                    transition: transform 0.5s ease;
                }
                .anime-mascot.spin {
                    transform: translate(-50%, -50%) rotate(360deg) scale(1.1);
                }
                @keyframes float {
                    0%, 100% { top: 50%; }
                    50% { top: 45%; }
                }
                .anime-eye {
                    width: 44px; height: 44px; background: #fff; border-radius: 50%;
                    position: absolute; top: 60px; overflow: hidden;
                    box-shadow: inset 0 2px 4px rgba(0,0,0,0.2);
                }
                .eye-left { left: 40px; }
                .eye-right { right: 40px; }
                .anime-pupil {
                    width: 22px; height: 22px; background: #3b82f6; border-radius: 50%;
                    position: absolute; top: 11px; left: 11px; transition: transform 0.1s ease-out;
                }
                .anime-pupil::after {
                    content: ''; position: absolute; top: 4px; left: 4px; width: 6px; height: 6px;
                    background: #fff; border-radius: 50%;
                }
                .anime-blush {
                    width: 26px; height: 12px; background: #ef4444; border-radius: 50%;
                    position: absolute; top: 105px; opacity: 0.6; filter: blur(3px);
                }
                .blush-left { left: 24px; }
                .blush-right { right: 24px; }
                .anime-mouth {
                    width: 20px; height: 12px; border-bottom: 4px solid #fff; border-radius: 0 0 20px 20px;
                    position: absolute; top: 105px; left: 90px; transition: all 0.2s;
                }
                .hero-anime-container:hover .anime-mouth {
                    width: 30px; left: 85px; height: 16px;
                }
                .anime-antenna {
                    width: 4px; height: 35px; background: #374151; position: absolute; top: -30px; left: 98px;
                }
                .anime-antenna::after {
                    content: ''; width: 14px; height: 14px; background: #60a5fa; border-radius: 50%;
                    position: absolute; top: -8px; left: -5px;
                    animation: pulse-glow 2s infinite;
                }
                @keyframes pulse-glow {
                    0%, 100% { box-shadow: 0 0 10px #60a5fa; transform: scale(1); }
                    50% { box-shadow: 0 0 20px #60a5fa, 0 0 30px #60a5fa; transform: scale(1.2); }
                }
                @media (max-width: 768px) {
                    .hero-anime-container { width: 200px; height: 200px; margin: 0 auto; }
                    .anime-mascot { transform: translate(-50%, -50%) scale(0.8); }
                    .anime-mascot.spin { transform: translate(-50%, -50%) rotate(360deg) scale(0.9); }
                }
            </style>
            <div class="anime-mascot">
                <div class="anime-antenna"></div>
                <div class="anime-eye eye-left"><div class="anime-pupil"></div></div>
                <div class="anime-eye eye-right"><div class="anime-pupil"></div></div>
                <div class="anime-blush blush-left"></div>
                <div class="anime-blush blush-right"></div>
                <div class="anime-mouth"></div>
            </div>
            <script>
                document.addEventListener('mousemove', (e) => {
                    const pupils = document.querySelectorAll('.anime-pupil');
                    const mascot = document.querySelector('.anime-mascot');
                    if (!mascot) return;
                    const rect = mascot.getBoundingClientRect();
                    
                    // Calculate center of the mascot
                    const mascotX = rect.left + rect.width / 2;
                    const mascotY = rect.top + rect.height / 2;
                    
                    // Angle and distance
                    const deltaX = e.clientX - mascotX;
                    const deltaY = e.clientY - mascotY;
                    const angle = Math.atan2(deltaY, deltaX);
                    const distance = Math.min(8, Math.hypot(deltaX, deltaY) / 15);
                    
                    const moveX = Math.cos(angle) * distance;
                    const moveY = Math.sin(angle) * distance;
                    
                    pupils.forEach(pupil => {
                        pupil.style.transform = `translate(${moveX}px, ${moveY}px)`;
                    });
                });
            </script>
            <p style="position:absolute; bottom:0; width:100%; text-align:center; font-size:12px; color:#9ca3af; font-weight:600; letter-spacing:1px;">CLICK ME!</p>
        </div>
    </section>

    <!-- Featured Products -->
    <section class="section" id="featured">
        <div class="section-header">
            <h2>Featured Products</h2>
            <p>Our top picks just for you</p>
        </div>

        @if($featuredProducts->count() > 0)
            <div class="product-grid">
                @foreach($featuredProducts as $product)
                    <a href="{{ route('products.show', $product) }}" class="product-card">
                        <div class="product-card-img">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                            @else
                                <i class="fas fa-cube placeholder-icon"></i>
                            @endif
                        </div>
                        <div class="product-card-body">
                            <h3>{{ $product->name }}</h3>
                            <p>{{ Str::limit($product->description, 100) }}</p>
                            <div class="product-card-footer">
                                <div class="product-price">
                                    ${{ number_format($product->price, 2) }}
                                </div>
                                <span class="product-stock {{ $product->quantity > 0 ? 'in-stock' : 'out-of-stock' }}">
                                    {{ $product->quantity > 0 ? 'In Stock' : 'Out of Stock' }}
                                </span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

            <div style="text-align: center; margin-top: 40px;">
                <a href="{{ route('products') }}" class="btn-hero btn-hero-outline">
                    View All Products <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        @else
            <div style="text-align: center; padding: 60px 20px; color: #6b7280;">
                <i class="fas fa-box-open" style="font-size: 40px; margin-bottom: 12px; color: #d1d5db;"></i>
                <h3 style="color: #6b7280; margin-bottom: 6px;">No Products Yet</h3>
                <p>Check back soon for amazing products!</p>
            </div>
        @endif
    </section>
@endsection
