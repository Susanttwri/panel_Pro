<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') — EduCRM Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        :root {
            --bg: #0a0f1e; --sidebar-bg: #0d1427; --card: #111827;
            --card-hover: #1a2235; --border: #1e2d45; --text: #e2e8f0;
            --muted: #64748b; --accent: #6366f1; --accent-light: #818cf8;
            --green: #10b981; --orange: #f59e0b; --red: #ef4444;
            --blue: #3b82f6; --purple: #8b5cf6; --sidebar-w: 260px;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background: var(--bg); color: var(--text); display: flex; min-height: 100vh; }
        .sidebar { width: var(--sidebar-w); background: var(--sidebar-bg); border-right: 1px solid var(--border); position: fixed; top: 0; left: 0; bottom: 0; display: flex; flex-direction: column; z-index: 100; overflow-y: auto; }
        .sidebar-logo { padding: 24px 20px; border-bottom: 1px solid var(--border); display: flex; align-items: center; gap: 12px; }
        .sidebar-logo .logo-icon { width: 40px; height: 40px; background: linear-gradient(135deg, var(--accent), var(--purple)); border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 18px; color: white; }
        .sidebar-logo h1 { font-size: 17px; font-weight: 700; color: var(--text); }
        .sidebar-logo span { font-size: 11px; color: var(--muted); display: block; }
        .sidebar-nav { padding: 16px 12px; flex: 1; }
        .nav-label { font-size: 10px; font-weight: 600; color: var(--muted); text-transform: uppercase; letter-spacing: 1px; padding: 8px 8px 4px; margin-top: 8px; }
        .nav-item { display: flex; align-items: center; gap: 10px; padding: 10px 12px; border-radius: 8px; color: var(--muted); text-decoration: none; font-size: 13.5px; font-weight: 500; transition: all .2s; margin-bottom: 2px; }
        .nav-item i { width: 18px; text-align: center; font-size: 14px; }
        .nav-item:hover { background: rgba(99,102,241,.1); color: var(--text); }
        .nav-item.active { background: rgba(99,102,241,.15); color: var(--accent-light); border-left: 3px solid var(--accent); }
        .sidebar-footer { padding: 16px 12px; border-top: 1px solid var(--border); }
        .user-card { display: flex; align-items: center; gap: 10px; padding: 10px; border-radius: 8px; background: rgba(255,255,255,.03); }
        .user-avatar { width: 34px; height: 34px; border-radius: 50%; background: linear-gradient(135deg, var(--accent), var(--purple)); display: flex; align-items: center; justify-content: center; font-size: 13px; color: white; font-weight: 600; }
        .user-info .name { font-size: 13px; font-weight: 600; color: var(--text); }
        .user-info .role { font-size: 11px; color: var(--muted); }
        .main { margin-left: var(--sidebar-w); flex: 1; display: flex; flex-direction: column; min-height: 100vh; }
        .topbar { background: var(--card); border-bottom: 1px solid var(--border); padding: 0 32px; height: 64px; display: flex; align-items: center; justify-content: space-between; position: sticky; top: 0; z-index: 50; }
        .page-title { font-size: 16px; font-weight: 600; color: var(--text); }
        .page-breadcrumb { font-size: 12px; color: var(--muted); margin-top: 2px; }
        .topbar-actions { display: flex; align-items: center; gap: 12px; }
        .topbar-btn { padding: 8px 16px; border-radius: 7px; font-size: 13px; font-weight: 500; cursor: pointer; text-decoration: none; display: flex; align-items: center; gap: 6px; transition: all .2s; }
        .btn-view-site { background: rgba(99,102,241,.1); color: var(--accent-light); border: 1px solid rgba(99,102,241,.2); }
        .btn-view-site:hover { background: rgba(99,102,241,.2); }
        .content { padding: 28px 32px; flex: 1; }
        .card { background: var(--card); border: 1px solid var(--border); border-radius: 14px; padding: 24px; margin-bottom: 24px; }
        .card-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        .card-title { font-size: 15px; font-weight: 700; color: var(--text); }
        .stats-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; margin-bottom: 24px; }
        .stat-card { background: var(--card); border: 1px solid var(--border); border-radius: 14px; padding: 20px; display: flex; align-items: center; gap: 16px; transition: all .2s; }
        .stat-card:hover { border-color: var(--accent); transform: translateY(-2px); box-shadow: 0 8px 24px rgba(0,0,0,.3); }
        .stat-icon { width: 48px; height: 48px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 20px; flex-shrink: 0; }
        .stat-icon.purple { background: rgba(139,92,246,.15); color: var(--purple); }
        .stat-icon.green  { background: rgba(16,185,129,.15);  color: var(--green); }
        .stat-icon.orange { background: rgba(245,158,11,.15);  color: var(--orange); }
        .stat-icon.blue   { background: rgba(59,130,246,.15);  color: var(--blue); }
        .stat-icon.red    { background: rgba(239,68,68,.15);   color: var(--red); }
        .stat-info h3 { font-size: 26px; font-weight: 800; color: var(--text); line-height: 1; }
        .stat-info p { font-size: 12px; color: var(--muted); margin-top: 4px; }
        .data-table { width: 100%; border-collapse: collapse; }
        .data-table th { text-align: left; padding: 10px 14px; font-size: 11px; font-weight: 600; color: var(--muted); text-transform: uppercase; letter-spacing: .5px; border-bottom: 1px solid var(--border); }
        .data-table td { padding: 12px 14px; font-size: 13.5px; color: var(--text); border-bottom: 1px solid rgba(30,45,69,.5); vertical-align: middle; }
        .data-table tr:hover td { background: rgba(255,255,255,.02); }
        .data-table tr:last-child td { border-bottom: none; }
        .badge { display: inline-flex; align-items: center; gap: 4px; padding: 3px 10px; border-radius: 20px; font-size: 11px; font-weight: 600; }
        .badge-success { background: rgba(16,185,129,.15); color: var(--green); }
        .badge-danger  { background: rgba(239,68,68,.15); color: var(--red); }
        .badge-warning { background: rgba(245,158,11,.15); color: var(--orange); }
        .badge-info    { background: rgba(59,130,246,.15); color: var(--blue); }
        .badge-purple  { background: rgba(139,92,246,.15); color: var(--purple); }
        .btn { display: inline-flex; align-items: center; gap: 6px; padding: 10px 18px; border-radius: 8px; font-size: 13px; font-weight: 600; cursor: pointer; border: none; text-decoration: none; transition: all .2s; font-family: 'Inter', sans-serif; }
        .btn-primary { background: var(--accent); color: white; }
        .btn-primary:hover { background: #5254f0; transform: translateY(-1px); box-shadow: 0 4px 12px rgba(99,102,241,.4); }
        .btn-secondary { background: rgba(255,255,255,.06); color: var(--text); border: 1px solid var(--border); }
        .btn-secondary:hover { background: rgba(255,255,255,.1); }
        .btn-warning { background: rgba(245,158,11,.15); color: var(--orange); border: 1px solid rgba(245,158,11,.3); }
        .btn-warning:hover { background: rgba(245,158,11,.25); }
        .btn-danger { background: rgba(239,68,68,.15); color: var(--red); border: 1px solid rgba(239,68,68,.3); }
        .btn-danger:hover { background: rgba(239,68,68,.25); }
        .btn-success { background: rgba(16,185,129,.15); color: var(--green); border: 1px solid rgba(16,185,129,.3); }
        .btn-success:hover { background: rgba(16,185,129,.25); }
        .btn-sm { padding: 6px 12px; font-size: 12px; }
        .actions-cell { display: flex; gap: 6px; align-items: center; }
        .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
        .form-group { display: flex; flex-direction: column; gap: 6px; margin-bottom: 16px; }
        .form-group.full { grid-column: 1 / -1; }
        .form-label { font-size: 12px; font-weight: 600; color: var(--muted); text-transform: uppercase; letter-spacing: .5px; }
        .form-control { background: rgba(255,255,255,.04); border: 1px solid var(--border); border-radius: 8px; padding: 10px 14px; font-size: 14px; color: var(--text); transition: all .2s; width: 100%; font-family: 'Inter', sans-serif; }
        .form-control:focus { outline: none; border-color: var(--accent); box-shadow: 0 0 0 3px rgba(99,102,241,.15); }
        .form-control option { background: var(--card); color: var(--text); }
        textarea.form-control { resize: vertical; min-height: 100px; }
        .form-check { display: flex; align-items: center; gap: 10px; cursor: pointer; }
        .form-check input[type=checkbox] { width: 16px; height: 16px; accent-color: var(--accent); cursor: pointer; }
        .form-check label { font-size: 13.5px; color: var(--text); cursor: pointer; }
        .alert { padding: 12px 16px; border-radius: 8px; margin-bottom: 20px; font-size: 13.5px; display: flex; align-items: flex-start; gap: 10px; }
        .alert-success { background: rgba(16,185,129,.1); color: var(--green); border: 1px solid rgba(16,185,129,.2); }
        .alert-danger { background: rgba(239,68,68,.1); color: var(--red); border: 1px solid rgba(239,68,68,.2); }
        .search-bar { display: flex; gap: 10px; margin-bottom: 20px; flex-wrap: wrap; }
        .search-input-wrap { position: relative; flex: 1; min-width: 220px; }
        .search-input-wrap i { position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: var(--muted); font-size: 13px; }
        .search-input { padding-left: 36px !important; }
        .progress-bar { background: rgba(255,255,255,.08); border-radius: 20px; height: 6px; overflow: hidden; width: 80px; }
        .progress-fill { height: 100%; border-radius: 20px; background: linear-gradient(90deg, var(--accent), var(--purple)); }
        .empty-state { text-align: center; padding: 60px 20px; color: var(--muted); }
        .empty-state i { font-size: 48px; margin-bottom: 16px; opacity: .3; display: block; }
        .empty-state h3 { font-size: 16px; font-weight: 600; color: var(--text); margin-bottom: 8px; }
        .empty-state p { font-size: 13px; margin-bottom: 20px; }
        .pagination-wrapper { display: flex; justify-content: center; margin-top: 24px; }
        .pagination-wrapper nav span, .pagination-wrapper nav a { display: inline-flex; align-items: center; justify-content: center; min-width: 34px; height: 34px; padding: 0 10px; margin: 0 2px; border-radius: 6px; font-size: 13px; font-weight: 500; text-decoration: none; transition: all .15s; }
        .pagination-wrapper nav span[aria-current] { background: var(--accent); color: white; }
        .pagination-wrapper nav a { background: var(--card); color: var(--muted); border: 1px solid var(--border); }
        .pagination-wrapper nav a:hover { background: var(--card-hover); color: var(--text); }
        .avatar { width: 36px; height: 36px; border-radius: 50%; background: linear-gradient(135deg, var(--accent), var(--purple)); display: flex; align-items: center; justify-content: center; font-size: 13px; font-weight: 700; color: white; flex-shrink: 0; text-transform: uppercase; }
        @media (max-width: 1200px) { .stats-grid { grid-template-columns: repeat(2, 1fr); } }
        @media (max-width: 768px) { .form-grid { grid-template-columns: 1fr; } }
    </style>
    @yield('styles')
</head>
<body>
    <aside class="sidebar">
        <div class="sidebar-logo">
            <div class="logo-icon"><i class="fas fa-graduation-cap"></i></div>
            <div>
                <h1>EduCRM</h1>
                <span>Admin Panel</span>
            </div>
        </div>
        <nav class="sidebar-nav">
            <div class="nav-label">Overview</div>
            <a href="{{ route('admin.dashboard') }}" class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fas fa-chart-pie"></i> Dashboard
            </a>
            <div class="nav-label">Management</div>
            <a href="{{ route('admin.students.index') }}" class="nav-item {{ request()->routeIs('admin.students.*') ? 'active' : '' }}">
                <i class="fas fa-user-graduate"></i> Students
            </a>
            <a href="{{ route('admin.courses.index') }}" class="nav-item {{ request()->routeIs('admin.courses.*') ? 'active' : '' }}">
                <i class="fas fa-book-open"></i> Courses
            </a>
            <a href="{{ route('admin.instructors.index') }}" class="nav-item {{ request()->routeIs('admin.instructors.*') ? 'active' : '' }}">
                <i class="fas fa-chalkboard-teacher"></i> Instructors
            </a>
            <a href="{{ route('admin.enrollments.index') }}" class="nav-item {{ request()->routeIs('admin.enrollments.*') ? 'active' : '' }}">
                <i class="fas fa-clipboard-list"></i> Enrollments
            </a>
            <div class="nav-label">Site</div>
            <a href="{{ route('home') }}" class="nav-item" target="_blank">
                <i class="fas fa-globe"></i> View Website
            </a>
        </nav>
        <div class="sidebar-footer">
            <div class="user-card">
                <div class="user-avatar">{{ substr(Auth::user()->name, 0, 1) }}</div>
                <div class="user-info">
                    <div class="name">{{ Auth::user()->name }}</div>
                    <div class="role">Administrator</div>
                </div>
            </div>
            <form action="{{ route('admin.logout') }}" method="POST" style="margin-top: 8px;">
                @csrf
                <button type="submit" class="btn btn-danger btn-sm" style="width: 100%; justify-content: center;">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </form>
        </div>
    </aside>

    <div class="main">
        <header class="topbar">
            <div>
                <div class="page-title">@yield('page-title', 'Dashboard')</div>
                <div class="page-breadcrumb">@yield('breadcrumb', 'Admin / Dashboard')</div>
            </div>
            <div class="topbar-actions">
                <a href="{{ route('home') }}" class="topbar-btn btn-view-site" target="_blank">
                    <i class="fas fa-external-link-alt"></i> View Site
                </a>
            </div>
        </header>
        <main class="content">
            @if(session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                </div>
            @endif
            @if($errors->any())
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle"></i>
                    <div>@foreach($errors->all() as $error)<div>{{ $error }}</div>@endforeach</div>
                </div>
            @endif
            @yield('content')
        </main>
    </div>
</body>
</html>
