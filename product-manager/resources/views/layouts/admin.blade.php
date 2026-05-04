<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - @yield('title', 'Dashboard')</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        *{margin:0;padding:0;box-sizing:border-box}
        body{font-family:'Inter',sans-serif;background:#f9fafb;color:#111827;min-height:100vh}
        .sidebar{position:fixed;top:0;left:0;width:240px;height:100vh;background:#fff;border-right:1px solid #e5e7eb;z-index:100;display:flex;flex-direction:column}
        .sidebar-brand{padding:20px;border-bottom:1px solid #e5e7eb;display:flex;align-items:center;gap:10px}
        .sidebar-brand .brand-icon{width:36px;height:36px;background:#111827;border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:16px;color:#fff}
        .sidebar-brand h2{font-size:16px;font-weight:700;color:#111827}
        .sidebar-brand span{font-size:11px;color:#9ca3af;font-weight:400}
        .sidebar-nav{flex:1;padding:12px 8px;overflow-y:auto}
        .nav-label{font-size:10px;font-weight:600;text-transform:uppercase;letter-spacing:1.5px;color:#9ca3af;padding:8px 12px 8px}
        .nav-item{display:flex;align-items:center;gap:10px;padding:10px 14px;border-radius:8px;color:#6b7280;text-decoration:none;font-size:14px;font-weight:500;transition:all .15s;margin-bottom:2px}
        .nav-item:hover{background:#f3f4f6;color:#111827}
        .nav-item.active{background:#111827;color:#fff}
        .nav-item i{width:18px;text-align:center;font-size:14px}
        .sidebar-footer{padding:12px 8px;border-top:1px solid #e5e7eb}
        .logout-btn{display:flex;align-items:center;gap:10px;padding:10px 14px;border-radius:8px;background:#fff;color:#dc2626;text-decoration:none;font-size:14px;font-weight:500;border:1px solid #fecaca;cursor:pointer;width:100%;transition:all .15s}
        .logout-btn:hover{background:#fef2f2}
        .main-content{margin-left:240px;min-height:100vh}
        .topbar{display:flex;justify-content:space-between;align-items:center;padding:16px 32px;background:#fff;border-bottom:1px solid #e5e7eb;position:sticky;top:0;z-index:50}
        .topbar h1{font-size:20px;font-weight:700;color:#111827}
        .topbar-actions{display:flex;align-items:center;gap:12px}
        .topbar-user{display:flex;align-items:center;gap:10px;padding:6px 14px;background:#f9fafb;border-radius:8px;border:1px solid #e5e7eb}
        .topbar-user .avatar{width:30px;height:30px;border-radius:6px;background:#111827;display:flex;align-items:center;justify-content:center;font-size:13px;font-weight:600;color:#fff}
        .topbar-user .info{font-size:13px}
        .topbar-user .info strong{color:#111827;font-weight:600}
        .topbar-user .info span{color:#9ca3af;font-size:11px}
        .content{padding:28px 32px}
        .card{background:#fff;border:1px solid #e5e7eb;border-radius:12px;padding:24px}
        .btn{display:inline-flex;align-items:center;gap:8px;padding:9px 18px;border-radius:8px;font-size:13px;font-weight:600;font-family:'Inter',sans-serif;cursor:pointer;border:none;transition:all .15s;text-decoration:none}
        .btn-primary{background:#111827;color:#fff}
        .btn-primary:hover{background:#1f2937}
        .btn-success{background:#16a34a;color:#fff}
        .btn-success:hover{background:#15803d}
        .btn-warning{background:#f59e0b;color:#fff}
        .btn-warning:hover{background:#d97706}
        .btn-danger{background:#dc2626;color:#fff}
        .btn-danger:hover{background:#b91c1c}
        .btn-sm{padding:6px 12px;font-size:12px}
        .btn-outline{background:#fff;border:1px solid #d1d5db;color:#374151}
        .btn-outline:hover{background:#f3f4f6}
        .data-table{width:100%;border-collapse:collapse}
        .data-table th{text-align:left;padding:12px 16px;font-size:11px;font-weight:600;text-transform:uppercase;letter-spacing:.5px;color:#9ca3af;border-bottom:1px solid #e5e7eb}
        .data-table td{padding:14px 16px;border-bottom:1px solid #f3f4f6;font-size:14px;vertical-align:middle}
        .data-table tr:hover td{background:#f9fafb}
        .data-table .product-img{width:44px;height:44px;border-radius:8px;object-fit:cover;border:1px solid #e5e7eb}
        .data-table .product-img-placeholder{width:44px;height:44px;border-radius:8px;background:#f3f4f6;display:flex;align-items:center;justify-content:center;color:#d1d5db;font-size:16px}
        .product-name{font-weight:600;color:#111827}
        .product-desc{font-size:12px;color:#9ca3af;margin-top:2px;max-width:250px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
        .price-tag{font-weight:700;color:#111827;font-size:14px}
        .badge{display:inline-flex;align-items:center;padding:3px 10px;border-radius:20px;font-size:11px;font-weight:600}
        .badge-success{background:#f0fdf4;color:#16a34a}
        .badge-danger{background:#fef2f2;color:#dc2626}
        .actions-cell{display:flex;gap:6px}
        .form-group{margin-bottom:18px}
        .form-group label{display:block;font-size:13px;font-weight:600;color:#374151;margin-bottom:6px}
        .form-control{width:100%;padding:10px 14px;background:#fff;border:1px solid #d1d5db;border-radius:8px;color:#111827;font-size:14px;font-family:'Inter',sans-serif;transition:border-color .15s}
        .form-control:focus{outline:none;border-color:#111827;box-shadow:0 0 0 3px rgba(17,24,39,.08)}
        .form-control::placeholder{color:#9ca3af}
        textarea.form-control{min-height:100px;resize:vertical}
        .form-check{display:flex;align-items:center;gap:8px}
        .form-check input[type="checkbox"]{width:16px;height:16px;accent-color:#111827}
        .form-row{display:grid;grid-template-columns:1fr 1fr;gap:16px}
        .file-input-wrapper{position:relative;border:2px dashed #d1d5db;border-radius:10px;padding:20px;text-align:center;transition:all .15s;cursor:pointer}
        .file-input-wrapper:hover{border-color:#9ca3af;background:#f9fafb}
        .file-input-wrapper input[type="file"]{position:absolute;top:0;left:0;width:100%;height:100%;opacity:0;cursor:pointer}
        .file-input-wrapper i{font-size:24px;color:#9ca3af;margin-bottom:6px}
        .file-input-wrapper p{font-size:13px;color:#6b7280}
        .current-image{margin-top:10px}
        .current-image img{width:80px;height:80px;object-fit:cover;border-radius:8px;border:1px solid #e5e7eb}
        .alert{padding:12px 18px;border-radius:8px;margin-bottom:16px;font-size:14px;font-weight:500;display:flex;align-items:center;gap:8px}
        .alert-success{background:#f0fdf4;color:#16a34a;border:1px solid #bbf7d0}
        .alert-error{background:#fef2f2;color:#dc2626;border:1px solid #fecaca}
        .pagination-wrapper{display:flex;justify-content:center;margin-top:20px}
        .pagination-wrapper nav span,.pagination-wrapper nav a{display:inline-flex;align-items:center;justify-content:center;min-width:34px;height:34px;padding:0 10px;margin:0 2px;border-radius:6px;font-size:13px;font-weight:500;text-decoration:none;transition:all .15s}
        .pagination-wrapper nav span[aria-current]{background:#111827;color:#fff}
        .pagination-wrapper nav a{background:#fff;color:#374151;border:1px solid #e5e7eb}
        .pagination-wrapper nav a:hover{background:#f3f4f6}
        .pagination-wrapper nav span:not([aria-current]){color:#9ca3af}
        .stats-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(180px,1fr));gap:16px;margin-bottom:24px}
        .stat-card{background:#fff;border:1px solid #e5e7eb;border-radius:12px;padding:18px;display:flex;align-items:center;gap:14px}
        .stat-icon{width:42px;height:42px;border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:18px}
        .stat-icon.purple{background:#f3f4f6;color:#111827}
        .stat-icon.green{background:#f0fdf4;color:#16a34a}
        .stat-icon.blue{background:#eff6ff;color:#2563eb}
        .stat-icon.orange{background:#fff7ed;color:#ea580c}
        .stat-info h3{font-size:22px;font-weight:700;color:#111827}
        .stat-info p{font-size:12px;color:#9ca3af;margin-top:2px}
        .empty-state{text-align:center;padding:60px 20px}
        .empty-state i{font-size:40px;color:#d1d5db;margin-bottom:12px}
        .empty-state h3{font-size:16px;color:#6b7280;margin-bottom:6px}
        .empty-state p{font-size:13px;color:#9ca3af;margin-bottom:16px}
        .delete-form{display:inline}
        .view-site-link{display:flex;align-items:center;gap:6px;padding:7px 14px;border-radius:6px;background:#f0fdf4;border:1px solid #bbf7d0;color:#16a34a;text-decoration:none;font-size:13px;font-weight:500;transition:all .15s}
        .view-site-link:hover{background:#dcfce7}
        @media(max-width:768px){.sidebar{transform:translateX(-100%)}.main-content{margin-left:0}.form-row{grid-template-columns:1fr}.content{padding:16px}.topbar{padding:12px 16px}}
    </style>
</head>
<body>
    <aside class="sidebar">
        <div class="sidebar-brand">
            <div class="brand-icon"><i class="fas fa-cube"></i></div>
            <div>
                <h2>PanelsPro</h2>
                <span>Product Manager</span>
            </div>
        </div>
        <nav class="sidebar-nav">
            <div class="nav-label">Management</div>
            <a href="{{ route('admin.products.index') }}" class="nav-item {{ request()->routeIs('admin.products.index') ? 'active' : '' }}">
                <i class="fas fa-boxes-stacked"></i> Products
            </a>
            <a href="{{ route('admin.products.create') }}" class="nav-item {{ request()->routeIs('admin.products.create') ? 'active' : '' }}">
                <i class="fas fa-plus-circle"></i> Add Product
            </a>
            <div class="nav-label" style="margin-top:12px">Quick Links</div>
            <a href="{{ route('home') }}" target="_blank" class="nav-item">
                <i class="fas fa-globe"></i> View Website
            </a>
            <a href="{{ route('products') }}" target="_blank" class="nav-item">
                <i class="fas fa-store"></i> Shop Page
            </a>
        </nav>
        <div class="sidebar-footer">
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-btn"><i class="fas fa-right-from-bracket"></i> Logout</button>
            </form>
        </div>
    </aside>
    <div class="main-content">
        <header class="topbar">
            <h1>@yield('title', 'Dashboard')</h1>
            <div class="topbar-actions">
                <a href="{{ route('home') }}" target="_blank" class="view-site-link"><i class="fas fa-external-link-alt"></i> View Site</a>
                <div class="topbar-user">
                    <div class="avatar">{{ substr(Auth::user()->name, 0, 1) }}</div>
                    <div class="info"><strong>{{ Auth::user()->name }}</strong><br><span>Administrator</span></div>
                </div>
            </div>
        </header>
        <div class="content">
            @if(session('success'))
                <div class="alert alert-success"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
            @endif
            @if($errors->any())
                <div class="alert alert-error"><i class="fas fa-exclamation-circle"></i><div>@foreach($errors->all() as $error)<div>{{ $error }}</div>@endforeach</div></div>
            @endif
            @yield('content')
        </div>
    </div>
</body>
</html>
