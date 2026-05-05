<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@yield('meta_description', 'Discover premium products at PanelsPro. Shop the best tech gadgets and accessories.')">
    <title>@yield('title', 'PanelsPro - Premium Products')</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Inter', sans-serif;
            background: #030712;
            color: #e2e8f0;
            min-height: 100vh;
        }

        /* Navbar */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            padding: 0 40px;
            height: 72px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: rgba(3, 7, 18, 0.85);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(139, 92, 246, 0.1);
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
        }

        .navbar-brand .logo {
            width: 36px;
            height: 36px;
            background: linear-gradient(135deg, #8b5cf6, #ec4899);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            color: white;
        }

        .navbar-brand h1 {
            font-size: 20px;
            font-weight: 800;
            background: linear-gradient(135deg, #c4b5fd, #f0abfc);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .navbar-links {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .navbar-links a {
            color: #94a3b8;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            padding: 8px 18px;
            border-radius: 8px;
            transition: all 0.2s ease;
        }

        .navbar-links a:hover,
        .navbar-links a.active {
            color: #e2e8f0;
            background: rgba(139, 92, 246, 0.1);
        }

        .admin-link {
            background: linear-gradient(135deg, #8b5cf6, #6366f1) !important;
            color: white !important;
            box-shadow: 0 2px 10px rgba(139, 92, 246, 0.3);
        }

        .admin-link:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 15px rgba(139, 92, 246, 0.4) !important;
        }

        /* Hero */
        .hero {
            min-height: 85vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 100px 40px 60px;
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle at 30% 40%, rgba(139, 92, 246, 0.08) 0%, transparent 50%),
                        radial-gradient(circle at 70% 60%, rgba(236, 72, 153, 0.06) 0%, transparent 50%),
                        radial-gradient(circle at 50% 50%, rgba(59, 130, 246, 0.04) 0%, transparent 40%);
            animation: heroGlow 8s ease-in-out infinite alternate;
        }

        @keyframes heroGlow {
            from { transform: rotate(0deg); }
            to { transform: rotate(10deg); }
        }

        .hero-content {
            position: relative;
            z-index: 1;
            max-width: 700px;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 6px 16px;
            background: rgba(139, 92, 246, 0.12);
            border: 1px solid rgba(139, 92, 246, 0.2);
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            color: #c4b5fd;
            margin-bottom: 24px;
        }

        .hero h1 {
            font-size: 56px;
            font-weight: 800;
            line-height: 1.1;
            margin-bottom: 20px;
            background: linear-gradient(135deg, #f1f5f9 0%, #c4b5fd 50%, #f0abfc 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .hero p {
            font-size: 18px;
            color: #64748b;
            line-height: 1.7;
            margin-bottom: 36px;
        }

        .hero-buttons {
            display: flex;
            gap: 16px;
            justify-content: center;
        }

        .btn-hero {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 14px 32px;
            border-radius: 12px;
            font-size: 15px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .btn-hero-primary {
            background: linear-gradient(135deg, #8b5cf6, #6366f1);
            color: white;
            box-shadow: 0 4px 20px rgba(139, 92, 246, 0.3);
        }

        .btn-hero-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(139, 92, 246, 0.4);
        }

        .btn-hero-outline {
            background: transparent;
            color: #c4b5fd;
            border: 1px solid rgba(139, 92, 246, 0.3);
        }

        .btn-hero-outline:hover {
            background: rgba(139, 92, 246, 0.1);
            transform: translateY(-2px);
        }

        /* Section */
        .section {
            padding: 80px 40px;
            max-width: 1280px;
            margin: 0 auto;
        }

        .section-header {
            text-align: center;
            margin-bottom: 48px;
        }

        .section-header h2 {
            font-size: 36px;
            font-weight: 800;
            margin-bottom: 12px;
            background: linear-gradient(135deg, #f1f5f9, #c4b5fd);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .section-header p {
            font-size: 16px;
            color: #64748b;
        }

        /* Product Grid */
        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 24px;
        }

        .product-card {
            background: rgba(15, 15, 35, 0.6);
            border: 1px solid rgba(139, 92, 246, 0.1);
            border-radius: 16px;
            overflow: hidden;
            transition: all 0.3s ease;
            text-decoration: none;
            color: inherit;
            display: block;
        }

        .product-card:hover {
            transform: translateY(-6px);
            border-color: rgba(139, 92, 246, 0.3);
            box-shadow: 0 20px 60px rgba(139, 92, 246, 0.1);
        }

        .product-card-img {
            width: 100%;
            height: 220px;
            background: linear-gradient(135deg, rgba(139, 92, 246, 0.08), rgba(236, 72, 153, 0.05));
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
        }

        .product-card-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .product-card-img .placeholder-icon {
            font-size: 48px;
            color: rgba(139, 92, 246, 0.25);
        }

        .product-card-body {
            padding: 20px;
        }

        .product-card-body h3 {
            font-size: 17px;
            font-weight: 700;
            color: #f1f5f9;
            margin-bottom: 8px;
        }

        .product-card-body p {
            font-size: 13px;
            color: #64748b;
            line-height: 1.6;
            margin-bottom: 16px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .product-card-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .product-price {
            font-size: 22px;
            font-weight: 800;
            color: #34d399;
        }

        .product-price span {
            font-size: 14px;
            font-weight: 400;
            color: #64748b;
        }

        .product-stock {
            font-size: 12px;
            padding: 4px 12px;
            border-radius: 20px;
        }

        .in-stock {
            background: rgba(16, 185, 129, 0.12);
            color: #34d399;
        }

        .out-of-stock {
            background: rgba(239, 68, 68, 0.12);
            color: #f87171;
        }

        /* Product Detail */
        .product-detail {
            padding: 120px 40px 80px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .product-detail-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 48px;
            align-items: start;
        }

        .product-detail-img {
            width: 100%;
            aspect-ratio: 1;
            background: rgba(15, 15, 35, 0.6);
            border: 1px solid rgba(139, 92, 246, 0.12);
            border-radius: 20px;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .product-detail-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .product-detail-img .placeholder-icon {
            font-size: 80px;
            color: rgba(139, 92, 246, 0.2);
        }

        .product-detail-info {
            padding: 12px 0;
        }

        .product-detail-info .breadcrumb {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 20px;
            font-size: 13px;
        }

        .product-detail-info .breadcrumb a {
            color: #64748b;
            text-decoration: none;
        }

        .product-detail-info .breadcrumb a:hover {
            color: #c4b5fd;
        }

        .product-detail-info .breadcrumb span {
            color: #475569;
        }

        .product-detail-info .breadcrumb .current {
            color: #c4b5fd;
        }

        .product-detail-info h1 {
            font-size: 32px;
            font-weight: 800;
            color: #f1f5f9;
            margin-bottom: 12px;
        }

        .product-detail-info .detail-price {
            font-size: 36px;
            font-weight: 800;
            color: #34d399;
            margin-bottom: 20px;
        }

        .product-detail-info .detail-desc {
            font-size: 15px;
            color: #94a3b8;
            line-height: 1.8;
            margin-bottom: 24px;
            padding-bottom: 24px;
            border-bottom: 1px solid rgba(139, 92, 246, 0.1);
        }

        .product-meta {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
            margin-bottom: 28px;
        }

        .meta-item {
            padding: 16px;
            background: rgba(26, 26, 62, 0.4);
            border-radius: 12px;
            border: 1px solid rgba(139, 92, 246, 0.08);
        }

        .meta-item .meta-label {
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #64748b;
            margin-bottom: 4px;
        }

        .meta-item .meta-value {
            font-size: 16px;
            font-weight: 700;
            color: #e2e8f0;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #c4b5fd;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            margin-top: 20px;
            padding: 10px 20px;
            border-radius: 10px;
            border: 1px solid rgba(139, 92, 246, 0.2);
            transition: all 0.2s;
        }

        .back-link:hover {
            background: rgba(139, 92, 246, 0.1);
        }

        /* Related Products */
        .related-section {
            padding: 60px 40px 80px;
            max-width: 1280px;
            margin: 0 auto;
        }

        /* Footer */
        .footer {
            padding: 40px;
            text-align: center;
            border-top: 1px solid rgba(139, 92, 246, 0.08);
            color: #475569;
            font-size: 13px;
        }

        .footer a {
            color: #8b5cf6;
            text-decoration: none;
        }

        /* Pagination */
        .pagination-wrapper {
            display: flex;
            justify-content: center;
            margin-top: 40px;
        }

        .pagination-wrapper nav span,
        .pagination-wrapper nav a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 40px;
            height: 40px;
            padding: 0 14px;
            margin: 0 3px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.2s;
        }

        .pagination-wrapper nav span[aria-current] {
            background: linear-gradient(135deg, #8b5cf6, #6366f1);
            color: white;
        }

        .pagination-wrapper nav a {
            background: rgba(15, 15, 35, 0.6);
            color: #94a3b8;
            border: 1px solid rgba(139, 92, 246, 0.12);
        }

        .pagination-wrapper nav a:hover {
            background: rgba(139, 92, 246, 0.15);
            color: #c4b5fd;
        }

        .pagination-wrapper nav span:not([aria-current]) {
            color: #475569;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .navbar { padding: 0 20px; }
            .hero h1 { font-size: 32px; }
            .hero p { font-size: 15px; }
            .hero-buttons { flex-direction: column; align-items: center; }
            .section { padding: 60px 20px; }
            .product-grid { grid-template-columns: 1fr; }
            .product-detail { padding: 100px 20px 60px; }
            .product-detail-grid { grid-template-columns: 1fr; }
            .product-meta { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <a href="{{ route('home') }}" class="navbar-brand">
            <div class="logo"><i class="fas fa-cube"></i></div>
            <h1>PanelsPro</h1>
        </a>
        <div class="navbar-links">
            <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
            <a href="{{ route('products') }}" class="{{ request()->routeIs('products') ? 'active' : '' }}">Products</a>
            @auth
                <a href="{{ route('admin.products.index') }}" class="admin-link">
                    <i class="fas fa-lock"></i> Admin
                </a>
            @else
                <a href="{{ route('admin.login') }}" class="admin-link">
                    <i class="fas fa-lock"></i> Admin
                </a>
            @endauth
        </div>
    </nav>

    @yield('content')

    <!-- Footer -->
    <footer class="footer">
        <p>&copy; {{ date('Y') }} <a href="{{ route('home') }}">PanelsPro</a>. All rights reserved. Built with Laravel & PHP.</p>
    </footer>
</body>
</html>
