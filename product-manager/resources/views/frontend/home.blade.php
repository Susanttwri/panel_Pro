@extends('layouts.frontend')

@section('title', 'PanelsPro - Premium Products')
@section('meta_description', 'Discover premium tech products at PanelsPro. Shop the best gadgets, accessories, and electronics.')

@section('content')
    <!-- Hero Section -->
    <section class="hero" style="position:relative; overflow:hidden; display:flex; flex-wrap:wrap; align-items:center; justify-content:center; gap:60px; min-height:85vh; padding:120px 40px 80px;">
        <!-- Interactive Canvas Background -->
        <canvas id="interactive-canvas" style="position:absolute; top:0; left:0; width:100%; height:100%; z-index:0; pointer-events:none;"></canvas>
        
        <div class="hero-content" id="tilt-element" style="position:relative; z-index:10; flex:1; min-width:300px; max-width:550px; text-align:left; background:rgba(255,255,255,0.7); backdrop-filter:blur(20px); padding:40px; border-radius:24px; border:1px solid rgba(255,255,255,0.5); box-shadow:0 20px 40px rgba(0,0,0,0.05); transform-style:preserve-3d;">
            <div class="hero-badge" style="transform:translateZ(30px);">
                <i class="fas fa-sparkles"></i>
                Next-Gen Experience
            </div>
            <h1 style="text-align:left; transform:translateZ(50px); font-size:54px; background:linear-gradient(135deg, #111827, #3b82f6); -webkit-background-clip:text; -webkit-text-fill-color:transparent;">Premium Products,<br>Curated For You</h1>
            <p style="text-align:left; transform:translateZ(40px); font-size:18px;">Discover our handpicked selection of premium tech gadgets and accessories. Interact with the elements, tilt the card, and explore the 3D scene!</p>
            <div class="hero-buttons" style="justify-content:flex-start; transform:translateZ(60px);">
                <a href="{{ route('products') }}" class="btn-hero btn-hero-primary" style="box-shadow: 0 10px 20px rgba(59, 130, 246, 0.3);">
                    <i class="fas fa-store"></i> Browse Products
                </a>
                <a href="#featured" class="btn-hero btn-hero-outline">
                    <i class="fas fa-arrow-down"></i> See Featured
                </a>
            </div>
        </div>
        
        <!-- Extreme Interactive 3D Spline Scene -->
        <div class="hero-spline-container" style="position:relative; z-index:10; width:100%; max-width:500px; height:500px; cursor:grab;">
            <script type="module" src="https://unpkg.com/@splinetool/viewer@1.0.94/build/spline-viewer.js"></script>
            <!-- A stunning interactive 3D Blue Robot character that follows mouse and reacts to clicks -->
            <spline-viewer url="https://prod.spline.design/qWwF7528e-vP1H38/scene.splinecode"></spline-viewer>
        </div>
    </section>

    <!-- Custom Interactive Scripts -->
    <script>
        // 1. 3D Tilt Effect for Hero Content
        const tiltEl = document.getElementById('tilt-element');
        tiltEl.addEventListener('mousemove', (e) => {
            const rect = tiltEl.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            const centerX = rect.width / 2;
            const centerY = rect.height / 2;
            const rotateX = ((y - centerY) / centerY) * -10;
            const rotateY = ((x - centerX) / centerX) * 10;
            tiltEl.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) scale3d(1.02, 1.02, 1.02)`;
        });
        tiltEl.addEventListener('mouseleave', () => {
            tiltEl.style.transform = `perspective(1000px) rotateX(0deg) rotateY(0deg) scale3d(1, 1, 1)`;
            tiltEl.style.transition = 'transform 0.5s cubic-bezier(0.23, 1, 0.32, 1)';
        });
        tiltEl.addEventListener('mouseenter', () => {
            tiltEl.style.transition = 'none';
        });

        // 2. Interactive Canvas Particle Network
        const canvas = document.getElementById('interactive-canvas');
        const ctx = canvas.getContext('2d');
        let width, height;
        let particles = [];
        const mouse = { x: -1000, y: -1000 };

        function resize() {
            width = canvas.width = canvas.offsetWidth;
            height = canvas.height = canvas.offsetHeight;
        }
        window.addEventListener('resize', resize);
        resize();

        document.querySelector('.hero').addEventListener('mousemove', (e) => {
            const rect = canvas.getBoundingClientRect();
            mouse.x = e.clientX - rect.left;
            mouse.y = e.clientY - rect.top;
        });
        document.querySelector('.hero').addEventListener('mouseleave', () => {
            mouse.x = -1000;
            mouse.y = -1000;
        });

        class Particle {
            constructor() {
                this.x = Math.random() * width;
                this.y = Math.random() * height;
                this.vx = (Math.random() - 0.5) * 1.5;
                this.vy = (Math.random() - 0.5) * 1.5;
                this.radius = Math.random() * 2 + 1;
                this.baseColor = '#3b82f6';
            }
            update() {
                this.x += this.vx;
                this.y += this.vy;

                if (this.x < 0 || this.x > width) this.vx *= -1;
                if (this.y < 0 || this.y > height) this.vy *= -1;

                // Mouse interaction - repel
                const dx = mouse.x - this.x;
                const dy = mouse.y - this.y;
                const distance = Math.sqrt(dx * dx + dy * dy);
                if (distance < 120) {
                    this.x -= dx * 0.05;
                    this.y -= dy * 0.05;
                }
            }
            draw() {
                ctx.beginPath();
                ctx.arc(this.x, this.y, this.radius, 0, Math.PI * 2);
                ctx.fillStyle = this.baseColor;
                ctx.fill();
            }
        }

        for (let i = 0; i < 60; i++) {
            particles.push(new Particle());
        }

        function animate() {
            ctx.clearRect(0, 0, width, height);
            
            particles.forEach(p => {
                p.update();
                p.draw();
            });

            // Connect particles
            for (let i = 0; i < particles.length; i++) {
                for (let j = i + 1; j < particles.length; j++) {
                    const dx = particles[i].x - particles[j].x;
                    const dy = particles[i].y - particles[j].y;
                    const distance = Math.sqrt(dx * dx + dy * dy);

                    if (distance < 150) {
                        ctx.beginPath();
                        ctx.strokeStyle = `rgba(59, 130, 246, ${1 - distance / 150})`;
                        ctx.lineWidth = 1;
                        ctx.moveTo(particles[i].x, particles[i].y);
                        ctx.lineTo(particles[j].x, particles[j].y);
                        ctx.stroke();
                    }
                }
            }

            // Connect to mouse
            particles.forEach(p => {
                const dx = mouse.x - p.x;
                const dy = mouse.y - p.y;
                const distance = Math.sqrt(dx * dx + dy * dy);
                if (distance < 200) {
                    ctx.beginPath();
                    ctx.strokeStyle = `rgba(17, 24, 39, ${0.5 - distance / 400})`;
                    ctx.lineWidth = 1.5;
                    ctx.moveTo(p.x, p.y);
                    ctx.lineTo(mouse.x, mouse.y);
                    ctx.stroke();
                }
            });

            requestAnimationFrame(animate);
        }
        animate();
    </script>

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
