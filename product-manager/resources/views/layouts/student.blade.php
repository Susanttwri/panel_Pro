<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Student Portal — PanelPro')</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        :root { --bg:#f3f4f6; --card:#fff; --border:#e5e7eb; --text:#111827; --muted:#6b7280; --accent:#111; }
        * { margin:0; padding:0; box-sizing:border-box; }
        body { font-family:'Inter',sans-serif; background:var(--bg); color:var(--text); min-height:100vh; }
        .student-nav { background:var(--card); border-bottom:1px solid var(--border); padding:0 5%; height:64px; display:flex; align-items:center; justify-content:space-between; position:sticky; top:0; z-index:100; }
        .student-nav-brand { display:flex; align-items:center; gap:10px; text-decoration:none; color:var(--text); font-weight:800; font-size:18px; }
        .student-nav-brand .icon { width:36px; height:36px; background:var(--accent); color:#fff; border-radius:10px; display:flex; align-items:center; justify-content:center; }
        .student-nav-links { display:flex; align-items:center; gap:6px; flex-wrap:wrap; }
        .student-nav-links a { text-decoration:none; color:var(--muted); font-size:14px; font-weight:500; padding:8px 14px; border-radius:8px; }
        .student-nav-links a:hover, .student-nav-links a.active { background:#f3f4f6; color:var(--text); }
        .nav-cart-badge { background:#f59e0b; color:#fff; font-size:10px; font-weight:700; padding:2px 6px; border-radius:999px; margin-left:4px; }
        .student-main { max-width:1200px; margin:0 auto; padding:32px 5% 60px; }
        .btn { display:inline-flex; align-items:center; gap:8px; padding:10px 18px; border-radius:8px; font-size:14px; font-weight:600; text-decoration:none; border:none; cursor:pointer; font-family:inherit; }
        .btn-primary { background:var(--accent); color:#fff; }
        .btn-ghost { background:#fff; color:var(--text); border:1px solid var(--border); }
        .alert { padding:14px 18px; border-radius:10px; margin-bottom:20px; font-size:14px; }
        .alert-success { background:#ecfdf5; border:1px solid #a7f3d0; color:#065f46; }
        .alert-error { background:#fef2f2; border:1px solid #fecaca; color:#991b1b; }
        .page-title { font-size:28px; font-weight:800; margin-bottom:8px; }
        .page-sub { color:var(--muted); font-size:15px; margin-bottom:28px; }
    </style>
    @yield('styles')
</head>
<body>
    <nav class="student-nav">
        <a href="{{ route('student.dashboard') }}" class="student-nav-brand">
            <span class="icon"><i class="fas fa-graduation-cap"></i></span>
            PanelPro Student
        </a>
        <div class="student-nav-links">
            <a href="{{ route('student.dashboard') }}" class="{{ request()->routeIs('student.dashboard') ? 'active' : '' }}">Dashboard</a>
            <a href="{{ route('student.courses') }}" class="{{ request()->routeIs('student.courses') ? 'active' : '' }}">Browse Courses</a>
            <a href="{{ route('student.cart.index') }}" class="{{ request()->routeIs('student.cart.*') ? 'active' : '' }}">
                <i class="fas fa-shopping-cart"></i> Cart
                @if(($cartCount ?? 0) > 0)<span class="nav-cart-badge">{{ $cartCount }}</span>@endif
            </a>
            <a href="{{ route('student.enrollments') }}" class="{{ request()->routeIs('student.enrollments') ? 'active' : '' }}">My Courses</a>
            <a href="{{ route('home') }}" class="btn-ghost btn" style="padding:8px 14px;">Public Site</a>
            <form action="{{ route('student.logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="btn-ghost btn" style="padding:8px 14px;">Logout</button>
            </form>
        </div>
    </nav>

    <main class="student-main">
        @if(session('cart_success'))
            <div class="alert alert-success"><i class="fas fa-check-circle"></i> {{ session('cart_success') }}</div>
        @endif
        @if(session('cart_error'))
            <div class="alert alert-error"><i class="fas fa-exclamation-circle"></i> {{ session('cart_error') }}</div>
        @endif
        @yield('content')
    </main>
</body>
</html>
