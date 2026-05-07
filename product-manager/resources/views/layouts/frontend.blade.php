<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@yield('meta_description', 'Discover premium products at PanelsPro.')">
    <title>@yield('title', 'PanelsPro')</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        *{margin:0;padding:0;box-sizing:border-box}
        body{font-family:'Inter',sans-serif;background:#fff;color:#111827;min-height:100vh}
        .navbar{position:fixed;top:0;left:0;right:0;z-index:1000;padding:0 40px;height:64px;display:flex;align-items:center;justify-content:space-between;background:rgba(255,255,255,0.95);backdrop-filter:blur(12px);border-bottom:1px solid #e5e7eb}
        .navbar-brand{display:flex;align-items:center;gap:10px;text-decoration:none}
        .navbar-brand .logo{width:32px;height:32px;background:#111827;border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:14px;color:#fff}
        .navbar-brand h1{font-size:18px;font-weight:700;color:#111827}
        .navbar-links{display:flex;align-items:center;gap:4px}
        .navbar-links a{color:#6b7280;text-decoration:none;font-size:14px;font-weight:500;padding:8px 16px;border-radius:6px;transition:all .15s}
        .navbar-links a:hover,.navbar-links a.active{color:#111827;background:#f3f4f6}
        .admin-link{background:#111827!important;color:#fff!important}
        .admin-link:hover{background:#1f2937!important;color:#fff!important}
        .hero{min-height:80vh;display:flex;align-items:center;justify-content:center;text-align:center;padding:100px 40px 60px}
        .hero-content{max-width:600px}
        .hero-badge{display:inline-flex;align-items:center;gap:6px;padding:5px 14px;background:#f3f4f6;border:1px solid #e5e7eb;border-radius:20px;font-size:12px;font-weight:600;color:#374151;margin-bottom:24px}
        .hero h1{font-size:48px;font-weight:800;line-height:1.1;margin-bottom:16px;color:#111827}
        .hero p{font-size:17px;color:#6b7280;line-height:1.7;margin-bottom:32px}
        .hero-buttons{display:flex;gap:12px;justify-content:center}
        .btn-hero{display:inline-flex;align-items:center;gap:8px;padding:12px 28px;border-radius:8px;font-size:14px;font-weight:600;text-decoration:none;transition:all .15s}
        .btn-hero-primary{background:#111827;color:#fff;box-shadow:0 4px 14px rgba(17, 24, 39, 0.25);transition:all .3s ease;}
        .btn-hero-primary:hover{background:#1f2937;transform:translateY(-2px);box-shadow:0 6px 20px rgba(17, 24, 39, 0.35);}
        .btn-hero-outline{background:#fff;color:#374151;border:1px solid #d1d5db}
        .btn-hero-outline:hover{background:#f9fafb;border-color:#9ca3af}
        .section{padding:80px 40px;max-width:1200px;margin:0 auto}
        .section-header{text-align:center;margin-bottom:48px}
        .section-header h2{font-size:28px;font-weight:700;margin-bottom:8px;color:#111827}
        .section-header p{font-size:15px;color:#6b7280}
        .product-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:20px}
        .product-card{background:#fff;border:1px solid #f3f4f6;border-radius:16px;overflow:hidden;transition:all .3s cubic-bezier(0.4, 0, 0.2, 1);text-decoration:none;color:inherit;display:block; position:relative;}
        .product-card:hover{transform:translateY(-8px);border-color:#e5e7eb;box-shadow:0 20px 40px rgba(0,0,0,.08);z-index:2;}
        .product-card-img{width:100%;height:200px;background:#f9fafb;display:flex;align-items:center;justify-content:center;overflow:hidden;}
        .product-card-img img{width:100%;height:100%;object-fit:cover;transition:all .5s cubic-bezier(0.4, 0, 0.2, 1);}
        .product-card:hover .product-card-img img{transform:scale(1.05);}
        .product-card-img .placeholder-icon{font-size:40px;color:#d1d5db}
        .product-card-body{padding:16px 20px 20px}
        .product-card-body h3{font-size:15px;font-weight:600;color:#111827;margin-bottom:6px}
        .product-card-body p{font-size:13px;color:#6b7280;line-height:1.5;margin-bottom:14px;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden}
        .product-card-footer{display:flex;justify-content:space-between;align-items:center}
        .product-price{font-size:18px;font-weight:700;color:#111827}
        .product-stock{font-size:11px;font-weight:600;padding:3px 10px;border-radius:20px}
        .in-stock{background:#f0fdf4;color:#16a34a}
        .out-of-stock{background:#fef2f2;color:#dc2626}
        .product-detail{padding:110px 40px 80px;max-width:1100px;margin:0 auto}
        .product-detail-grid{display:grid;grid-template-columns:1fr 1fr;gap:48px;align-items:start}
        .product-detail-img{width:100%;aspect-ratio:1;background:#f9fafb;border:1px solid #e5e7eb;border-radius:12px;overflow:hidden;display:flex;align-items:center;justify-content:center}
        .product-detail-img img{width:100%;height:100%;object-fit:cover}
        .product-detail-img .placeholder-icon{font-size:64px;color:#d1d5db}
        .product-detail-info{padding:8px 0}
        .product-detail-info .breadcrumb{display:flex;align-items:center;gap:8px;margin-bottom:20px;font-size:13px}
        .product-detail-info .breadcrumb a{color:#6b7280;text-decoration:none}
        .product-detail-info .breadcrumb a:hover{color:#111827}
        .product-detail-info .breadcrumb span{color:#d1d5db}
        .product-detail-info .breadcrumb .current{color:#111827;font-weight:500}
        .product-detail-info h1{font-size:28px;font-weight:700;color:#111827;margin-bottom:12px}
        .product-detail-info .detail-price{font-size:32px;font-weight:700;color:#111827;margin-bottom:20px}
        .product-detail-info .detail-desc{font-size:15px;color:#6b7280;line-height:1.7;margin-bottom:24px;padding-bottom:24px;border-bottom:1px solid #e5e7eb}
        .product-meta{display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-bottom:28px}
        .meta-item{padding:14px;background:#f9fafb;border-radius:8px;border:1px solid #f3f4f6}
        .meta-item .meta-label{font-size:11px;font-weight:600;text-transform:uppercase;letter-spacing:.5px;color:#9ca3af;margin-bottom:4px}
        .meta-item .meta-value{font-size:15px;font-weight:600;color:#111827}
        .back-link{display:inline-flex;align-items:center;gap:8px;color:#374151;text-decoration:none;font-size:14px;font-weight:500;margin-top:16px;padding:10px 20px;border-radius:8px;border:1px solid #d1d5db;transition:all .15s}
        .back-link:hover{background:#f9fafb}
        .related-section{padding:40px 40px 80px;max-width:1200px;margin:0 auto}
        .pagination-wrapper{display:flex;justify-content:center;margin-top:40px}
        .pagination-wrapper nav span,.pagination-wrapper nav a{display:inline-flex;align-items:center;justify-content:center;min-width:36px;height:36px;padding:0 12px;margin:0 2px;border-radius:6px;font-size:13px;font-weight:500;text-decoration:none;transition:all .15s}
        .pagination-wrapper nav span[aria-current]{background:#111827;color:#fff}
        .pagination-wrapper nav a{background:#fff;color:#374151;border:1px solid #e5e7eb}
        .pagination-wrapper nav a:hover{background:#f3f4f6}
        .pagination-wrapper nav span:not([aria-current]){color:#9ca3af}
        @media(max-width:768px){.navbar{padding:0 20px}.hero h1{font-size:32px}.hero p{font-size:15px}.hero-buttons{flex-direction:column;align-items:center}.section{padding:60px 20px}.product-grid{grid-template-columns:1fr}.product-detail{padding:90px 20px 60px}.product-detail-grid{grid-template-columns:1fr}.product-meta{grid-template-columns:1fr}}
    </style>
</head>
<body>
    <nav class="navbar">
        <a href="{{ route('home') }}" class="navbar-brand">
            <div class="logo"><i class="fas fa-cube"></i></div>
            <h1>PanelsPro</h1>
        </a>
        <div class="navbar-links">
            <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
            <a href="{{ route('products') }}" class="{{ request()->routeIs('products') ? 'active' : '' }}">Products</a>
            @auth
                <a href="{{ route('admin.products.index') }}" class="admin-link"><i class="fas fa-lock"></i> Admin</a>
            @else
                <a href="{{ route('admin.login') }}" class="admin-link"><i class="fas fa-lock"></i> Admin</a>
            @endauth
        </div>
    </nav>
    @yield('content')

    <footer style="margin-top:auto; padding:40px; text-align:center; border-top:1px solid #e5e7eb; color:#6b7280; font-size:14px; background:#f9fafb; transition:all .3s;">
        <div style="display:flex; justify-content:center; gap:24px; margin-bottom:16px; font-size:18px;">
            <a href="#" style="color:#9ca3af; text-decoration:none; transition:color 0.2s;"><i class="fab fa-twitter hover:text-gray-900"></i></a>
            <a href="#" style="color:#9ca3af; text-decoration:none; transition:color 0.2s;"><i class="fab fa-github hover:text-gray-900"></i></a>
            <a href="#" style="color:#9ca3af; text-decoration:none; transition:color 0.2s;"><i class="fab fa-instagram hover:text-gray-900"></i></a>
        </div>
        <p>&copy; {{ date('Y') }} PanelsPro. All rights reserved.</p>
    </footer>
</body>
</html>
