<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Admin Panel - Product Manager">
    <title>Admin Panel - @yield('title', 'Dashboard')</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Inter', sans-serif;
            background: #0f0f23;
            color: #e2e8f0;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 260px;
            height: 100vh;
            background: linear-gradient(180deg, #1a1a3e 0%, #16163a 50%, #0f0f23 100%);
            border-right: 1px solid rgba(139, 92, 246, 0.15);
            z-index: 100;
            display: flex;
            flex-direction: column;
            transition: transform 0.3s ease;
        }

        .sidebar-brand {
            padding: 24px 20px;
            border-bottom: 1px solid rgba(139, 92, 246, 0.15);
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .sidebar-brand .brand-icon {
            width: 42px;
            height: 42px;
            background: linear-gradient(135deg, #8b5cf6, #6366f1);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            color: white;
            box-shadow: 0 4px 15px rgba(139, 92, 246, 0.3);
        }

        .sidebar-brand h2 {
            font-size: 18px;
            font-weight: 700;
            background: linear-gradient(135deg, #c4b5fd, #818cf8);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .sidebar-brand span {
            font-size: 11px;
            color: #64748b;
            font-weight: 400;
        }

        .sidebar-nav {
            flex: 1;
            padding: 16px 12px;
            overflow-y: auto;
        }

        .nav-label {
            font-size: 10px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: #64748b;
            padding: 8px 12px 12px;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            border-radius: 10px;
            color: #94a3b8;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.2s ease;
            margin-bottom: 4px;
        }

        .nav-item:hover {
            background: rgba(139, 92, 246, 0.1);
            color: #c4b5fd;
        }

        .nav-item.active {
            background: linear-gradient(135deg, rgba(139, 92, 246, 0.2), rgba(99, 102, 241, 0.15));
            color: #c4b5fd;
            box-shadow: 0 0 20px rgba(139, 92, 246, 0.1);
        }

        .nav-item i {
            width: 20px;
            text-align: center;
            font-size: 16px;
        }

        .sidebar-footer {
            padding: 16px 12px;
            border-top: 1px solid rgba(139, 92, 246, 0.15);
        }

        .logout-btn {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            border-radius: 10px;
            background: rgba(239, 68, 68, 0.1);
            color: #f87171;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            border: none;
            cursor: pointer;
            width: 100%;
            transition: all 0.2s ease;
        }

        .logout-btn:hover {
            background: rgba(239, 68, 68, 0.2);
        }

        /* Main Content */
        .main-content {
            margin-left: 260px;
            min-height: 100vh;
        }

        /* Top Bar */
        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 16px 32px;
            background: rgba(15, 15, 35, 0.8);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(139, 92, 246, 0.1);
            position: sticky;
            top: 0;
            z-index: 50;
        }

        .topbar h1 {
            font-size: 22px;
            font-weight: 700;
            color: #f1f5f9;
        }

        .topbar-actions {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .topbar-user {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px 16px;
            background: rgba(139, 92, 246, 0.1);
            border-radius: 10px;
            border: 1px solid rgba(139, 92, 246, 0.15);
        }

        .topbar-user .avatar {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            background: linear-gradient(135deg, #8b5cf6, #6366f1);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            font-weight: 600;
            color: white;
        }

        .topbar-user .info {
            font-size: 13px;
        }

        .topbar-user .info strong {
            color: #e2e8f0;
            font-weight: 600;
        }

        .topbar-user .info span {
            color: #64748b;
            font-size: 11px;
        }

        /* Content Area */
        .content {
            padding: 32px;
        }

        /* Cards */
        .card {
            background: rgba(26, 26, 62, 0.6);
            border: 1px solid rgba(139, 92, 246, 0.12);
            border-radius: 16px;
            padding: 24px;
            backdrop-filter: blur(10px);
        }

        /* Buttons */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            font-family: 'Inter', sans-serif;
            cursor: pointer;
            border: none;
            transition: all 0.2s ease;
            text-decoration: none;
        }

        .btn-primary {
            background: linear-gradient(135deg, #8b5cf6, #6366f1);
            color: white;
            box-shadow: 0 4px 15px rgba(139, 92, 246, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(139, 92, 246, 0.4);
        }

        .btn-success {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
        }

        .btn-success:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
        }

        .btn-warning {
            background: linear-gradient(135deg, #f59e0b, #d97706);
            color: white;
        }

        .btn-danger {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: white;
        }

        .btn-sm {
            padding: 6px 14px;
            font-size: 12px;
            border-radius: 8px;
        }

        .btn-outline {
            background: transparent;
            border: 1px solid rgba(139, 92, 246, 0.3);
            color: #c4b5fd;
        }

        .btn-outline:hover {
            background: rgba(139, 92, 246, 0.1);
        }

        /* Table */
        .data-table {
            width: 100%;
            border-collapse: collapse;
        }

        .data-table th {
            text-align: left;
            padding: 14px 16px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #64748b;
            border-bottom: 1px solid rgba(139, 92, 246, 0.1);
        }

        .data-table td {
            padding: 16px;
            border-bottom: 1px solid rgba(139, 92, 246, 0.06);
            font-size: 14px;
            vertical-align: middle;
        }

        .data-table tr:hover td {
            background: rgba(139, 92, 246, 0.04);
        }

        .data-table .product-img {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            object-fit: cover;
            border: 2px solid rgba(139, 92, 246, 0.15);
        }

        .data-table .product-img-placeholder {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            background: linear-gradient(135deg, rgba(139, 92, 246, 0.15), rgba(99, 102, 241, 0.1));
            display: flex;
            align-items: center;
            justify-content: center;
            color: #6366f1;
            font-size: 18px;
        }

        .product-name {
            font-weight: 600;
            color: #e2e8f0;
        }

        .product-desc {
            font-size: 12px;
            color: #64748b;
            margin-top: 2px;
            max-width: 250px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .price-tag {
            font-weight: 700;
            color: #34d399;
            font-size: 15px;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
        }

        .badge-success {
            background: rgba(16, 185, 129, 0.15);
            color: #34d399;
        }

        .badge-danger {
            background: rgba(239, 68, 68, 0.15);
            color: #f87171;
        }

        .actions-cell {
            display: flex;
            gap: 8px;
        }

        /* Forms */
        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #c4b5fd;
            margin-bottom: 8px;
        }

        .form-control {
            width: 100%;
            padding: 12px 16px;
            background: rgba(15, 15, 35, 0.6);
            border: 1px solid rgba(139, 92, 246, 0.2);
            border-radius: 10px;
            color: #e2e8f0;
            font-size: 14px;
            font-family: 'Inter', sans-serif;
            transition: border-color 0.2s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: #8b5cf6;
            box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.15);
        }

        .form-control::placeholder {
            color: #475569;
        }

        textarea.form-control {
            min-height: 120px;
            resize: vertical;
        }

        .form-check {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .form-check input[type="checkbox"] {
            width: 18px;
            height: 18px;
            accent-color: #8b5cf6;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        /* File Input */
        .file-input-wrapper {
            position: relative;
            border: 2px dashed rgba(139, 92, 246, 0.25);
            border-radius: 12px;
            padding: 24px;
            text-align: center;
            transition: all 0.2s;
            cursor: pointer;
        }

        .file-input-wrapper:hover {
            border-color: rgba(139, 92, 246, 0.5);
            background: rgba(139, 92, 246, 0.05);
        }

        .file-input-wrapper input[type="file"] {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
        }

        .file-input-wrapper i {
            font-size: 28px;
            color: #8b5cf6;
            margin-bottom: 8px;
        }

        .file-input-wrapper p {
            font-size: 13px;
            color: #64748b;
        }

        /* Image Preview */
        .current-image {
            margin-top: 12px;
        }

        .current-image img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 10px;
            border: 2px solid rgba(139, 92, 246, 0.2);
        }

        /* Alerts */
        .alert {
            padding: 14px 20px;
            border-radius: 12px;
            margin-bottom: 20px;
            font-size: 14px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 10px;
            animation: slideDown 0.3s ease;
        }

        .alert-success {
            background: rgba(16, 185, 129, 0.15);
            color: #34d399;
            border: 1px solid rgba(16, 185, 129, 0.2);
        }

        .alert-error {
            background: rgba(239, 68, 68, 0.15);
            color: #f87171;
            border: 1px solid rgba(239, 68, 68, 0.2);
        }

        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Pagination */
        .pagination-wrapper {
            display: flex;
            justify-content: center;
            margin-top: 24px;
        }

        .pagination-wrapper nav span,
        .pagination-wrapper nav a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 36px;
            height: 36px;
            padding: 0 12px;
            margin: 0 3px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.2s;
        }

        .pagination-wrapper nav span[aria-current] {
            background: linear-gradient(135deg, #8b5cf6, #6366f1);
            color: white;
        }

        .pagination-wrapper nav a {
            background: rgba(26, 26, 62, 0.6);
            color: #94a3b8;
            border: 1px solid rgba(139, 92, 246, 0.1);
        }

        .pagination-wrapper nav a:hover {
            background: rgba(139, 92, 246, 0.15);
            color: #c4b5fd;
        }

        .pagination-wrapper nav span:not([aria-current]) {
            color: #475569;
        }

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 28px;
        }

        .stat-card {
            background: rgba(26, 26, 62, 0.6);
            border: 1px solid rgba(139, 92, 246, 0.12);
            border-radius: 16px;
            padding: 20px;
            display: flex;
            align-items: center;
            gap: 16px;
            transition: transform 0.2s ease;
        }

        .stat-card:hover {
            transform: translateY(-2px);
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        .stat-icon.purple { background: rgba(139, 92, 246, 0.15); color: #8b5cf6; }
        .stat-icon.green { background: rgba(16, 185, 129, 0.15); color: #10b981; }
        .stat-icon.blue { background: rgba(59, 130, 246, 0.15); color: #3b82f6; }
        .stat-icon.orange { background: rgba(245, 158, 11, 0.15); color: #f59e0b; }

        .stat-info h3 {
            font-size: 24px;
            font-weight: 700;
            color: #f1f5f9;
        }

        .stat-info p {
            font-size: 12px;
            color: #64748b;
            margin-top: 2px;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
        }

        .empty-state i {
            font-size: 48px;
            color: rgba(139, 92, 246, 0.3);
            margin-bottom: 16px;
        }

        .empty-state h3 {
            font-size: 18px;
            color: #94a3b8;
            margin-bottom: 8px;
        }

        .empty-state p {
            font-size: 14px;
            color: #64748b;
            margin-bottom: 20px;
        }

        /* Delete confirm */
        .delete-form {
            display: inline;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); }
            .main-content { margin-left: 0; }
            .form-row { grid-template-columns: 1fr; }
            .content { padding: 16px; }
            .topbar { padding: 12px 16px; }
        }

        /* View Site Link */
        .view-site-link {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            border-radius: 8px;
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid rgba(16, 185, 129, 0.2);
            color: #34d399;
            text-decoration: none;
            font-size: 13px;
            font-weight: 500;
            transition: all 0.2s;
        }

        .view-site-link:hover {
            background: rgba(16, 185, 129, 0.2);
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="sidebar-brand">
            <div class="brand-icon">
                <i class="fas fa-cube"></i>
            </div>
            <div>
                <h2>PanelsPro</h2>
                <span>Product Manager</span>
            </div>
        </div>

        <nav class="sidebar-nav">
            <div class="nav-label">Management</div>
            <a href="{{ route('admin.products.index') }}" class="nav-item {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                <i class="fas fa-boxes-stacked"></i>
                Products
            </a>
            <a href="{{ route('admin.products.create') }}" class="nav-item">
                <i class="fas fa-plus-circle"></i>
                Add Product
            </a>

            <div class="nav-label" style="margin-top: 16px;">Quick Links</div>
            <a href="{{ route('home') }}" target="_blank" class="nav-item">
                <i class="fas fa-globe"></i>
                View Website
            </a>
            <a href="{{ route('products') }}" target="_blank" class="nav-item">
                <i class="fas fa-store"></i>
                Shop Page
            </a>
        </nav>

        <div class="sidebar-footer">
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-btn">
                    <i class="fas fa-right-from-bracket"></i>
                    Logout
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Top Bar -->
        <header class="topbar">
            <h1>@yield('title', 'Dashboard')</h1>
            <div class="topbar-actions">
                <a href="{{ route('home') }}" target="_blank" class="view-site-link">
                    <i class="fas fa-external-link-alt"></i>
                    View Site
                </a>
                <div class="topbar-user">
                    <div class="avatar">{{ substr(Auth::user()->name, 0, 1) }}</div>
                    <div class="info">
                        <strong>{{ Auth::user()->name }}</strong><br>
                        <span>Administrator</span>
                    </div>
                </div>
            </div>
        </header>

        <!-- Content -->
        <div class="content">
            @if(session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i>
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-error">
                    <i class="fas fa-exclamation-circle"></i>
                    <div>
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                </div>
            @endif

            @yield('content')
        </div>
    </div>
</body>
</html>
