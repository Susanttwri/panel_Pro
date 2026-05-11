<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@yield('meta_description', 'Edu — The premier educational platform for modern learners.')">
    <title>@yield('title', 'Edu — Learn Without Limits')</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        :root {
            --bg: #ffffff; --surface: #f8f9fa; --card: #ffffff;
            --border: #e5e7eb; --text: #111827; --muted: #6b7280;
            --accent: #000000; --accent2: #333333; --green: #10b981;
            --orange: #f59e0b;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body { font-family: 'Inter', sans-serif; background: var(--bg); color: var(--text); overflow-x: hidden; }

        /* NAV */
        .nav { position: fixed; top: 0; left: 0; right: 0; z-index: 1000; padding: 0 5%; height: 68px; display: flex; align-items: center; justify-content: space-between; background: rgba(243, 244, 246, 0.95); backdrop-filter: blur(24px); border-bottom: 1px solid var(--border); transition: all .3s; }
        .nav-brand { display: flex; align-items: center; gap: 10px; text-decoration: none; }
        .nav-brand .brand-icon { width: 38px; height: 38px; background: linear-gradient(135deg, var(--accent), var(--accent2)); border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 16px; color: #fff; }
        .nav-brand h1 { font-size: 19px; font-weight: 800; color: var(--text); letter-spacing: -.3px; }
        .nav-links { display: flex; align-items: center; gap: 4px; }
        .nav-toggle { display: none; background: transparent; border: 1px solid var(--border); border-radius: 8px; width: 38px; height: 38px; align-items: center; justify-content: center; cursor: pointer; color: var(--text); }
        .nav-links a { color: var(--muted); text-decoration: none; font-size: 14px; font-weight: 500; padding: 7px 14px; border-radius: 7px; transition: all .2s; }
        .nav-links a:hover, .nav-links a.active { color: var(--text); background: rgba(0,0,0,.05); }
        .nav-cta { background: linear-gradient(135deg, var(--accent), var(--accent2)) !important; color: #fff !important; padding: 8px 18px !important; font-weight: 600 !important; }
        .nav-cta:hover { transform: translateY(-1px); box-shadow: 0 8px 20px rgba(0,0,0,.2); background: linear-gradient(135deg, #222, #444) !important; }

        /* HERO */
        .hero { min-height: 100vh; display: flex; align-items: center; justify-content: center; text-align: center; position: relative; padding: 100px 5% 60px; overflow: hidden; }
        .hero-bg { position: absolute; inset: 0; background: radial-gradient(ellipse 80% 60% at 50% 40%, rgba(0,0,0,.03) 0%, transparent 70%), radial-gradient(ellipse 50% 40% at 80% 60%, rgba(0,0,0,.02) 0%, transparent 60%); }
        .hero-grid { position: absolute; inset: 0; background-image: linear-gradient(rgba(0,0,0,.04) 1px, transparent 1px), linear-gradient(90deg, rgba(0,0,0,.04) 1px, transparent 1px); background-size: 50px 50px; }
        .hero-content { position: relative; z-index: 2; max-width: 820px; }
        .hero-badge { display: inline-flex; align-items: center; gap: 8px; padding: 6px 16px; background: rgba(0,0,0,.04); border: 1px solid rgba(0,0,0,.1); border-radius: 30px; font-size: 12px; font-weight: 600; color: #333; margin-bottom: 28px; }
        .hero-badge i { font-size: 10px; }
        .hero h1 { font-size: clamp(38px, 6vw, 72px); font-weight: 900; line-height: 1.05; letter-spacing: -1.5px; margin-bottom: 20px; background: linear-gradient(135deg, #111827 40%, #6b7280); background-clip: text; -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        .hero p { font-size: 17px; color: var(--muted); line-height: 1.8; margin-bottom: 36px; max-width: 560px; margin-left: auto; margin-right: auto; }
        .hero-btns { display: flex; gap: 12px; justify-content: center; flex-wrap: wrap; }
        .btn-hero { display: inline-flex; align-items: center; gap: 8px; padding: 14px 28px; border-radius: 10px; font-size: 14px; font-weight: 700; text-decoration: none; transition: all .25s; cursor: pointer; border: none; font-family: 'Inter', sans-serif; }
        .btn-hero-primary { background: linear-gradient(135deg, var(--accent), var(--accent2)); color: #fff; box-shadow: 0 10px 30px rgba(0,0,0,.15); }
        .btn-hero-primary:hover { transform: translateY(-3px); box-shadow: 0 16px 40px rgba(0,0,0,.25); }
        .btn-hero-ghost { background: rgba(0,0,0,.03); color: var(--text); border: 1px solid rgba(0,0,0,.1); }
        .btn-hero-ghost:hover { background: rgba(0,0,0,.06); border-color: rgba(0,0,0,.2); transform: translateY(-2px); }
        .hero-stats { display: flex; justify-content: center; gap: 48px; margin-top: 64px; flex-wrap: wrap; }
        .hero-stat { text-align: center; }
        .hero-stat-num { font-size: 32px; font-weight: 900; background: linear-gradient(135deg, #111, #555); background-clip: text; -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        .hero-stat-label { font-size: 12px; color: var(--muted); margin-top: 4px; }

        /* SECTION */
        .section { padding: 90px 5%; max-width: 1300px; margin: 0 auto; }
        .section-label { display: inline-flex; align-items: center; gap: 8px; font-size: 12px; font-weight: 700; color: var(--accent); text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 14px; }
        .section-title { font-size: clamp(26px, 3.5vw, 40px); font-weight: 800; letter-spacing: -.5px; margin-bottom: 14px; color: var(--text); }
        .section-sub { font-size: 16px; color: var(--muted); line-height: 1.7; max-width: 560px; }
        .section-header { margin-bottom: 52px; }
        .section-header.center { text-align: center; }
        .section-header.center .section-sub { margin: 0 auto; }

        /* COURSE CARDS */
        .courses-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 20px; }
        .course-card { background: var(--card); border: 1px solid var(--border); border-radius: 16px; overflow: hidden; text-decoration: none; color: inherit; display: flex; flex-direction: column; transition: all .3s cubic-bezier(.4,0,.2,1); box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05); }
        .course-card:hover { border-color: rgba(0,0,0,.2); transform: translateY(-6px); box-shadow: 0 20px 40px rgba(0,0,0,.1), 0 0 0 1px rgba(0,0,0,.05); }
        .course-card-img { height: 180px; background: linear-gradient(135deg, rgba(0,0,0,.05), rgba(0,0,0,.02)); display: flex; align-items: center; justify-content: center; font-size: 48px; color: var(--muted); overflow: hidden; }
        .course-card-img img { width: 100%; height: 100%; object-fit: cover; }
        .course-card-body { padding: 20px; flex: 1; display: flex; flex-direction: column; }
        .course-meta { display: flex; align-items: center; gap: 8px; margin-bottom: 10px; flex-wrap: wrap; }
        .tag { display: inline-flex; align-items: center; padding: 3px 10px; border-radius: 20px; font-size: 11px; font-weight: 600; }
        .tag-purple { background: rgba(139,92,246,.15); color: #a78bfa; }
        .tag-green  { background: rgba(16,185,129,.15); color: #34d399; }
        .tag-orange { background: rgba(245,158,11,.15); color: #fbbf24; }
        .tag-red    { background: rgba(239,68,68,.15); color: #f87171; }
        .tag-blue   { background: rgba(59,130,246,.15); color: #60a5fa; }
        .course-title { font-size: 15px; font-weight: 700; color: var(--text); margin-bottom: 8px; line-height: 1.4; }
        .course-instructor { font-size: 12px; color: var(--muted); margin-bottom: 14px; }
        .course-footer { margin-top: auto; display: flex; justify-content: space-between; align-items: center; padding-top: 14px; border-top: 1px solid var(--border); }
        .course-price { font-size: 20px; font-weight: 800; color: var(--text); }
        .course-price.free { color: var(--green); }
        .course-info { display: flex; gap: 12px; font-size: 11px; color: var(--muted); }
        .course-info span { display: flex; align-items: center; gap: 4px; }

        /* INSTRUCTOR CARDS */
        .instructors-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(240px, 1fr)); gap: 20px; }
        .instructor-card { background: var(--card); border: 1px solid var(--border); border-radius: 16px; padding: 28px 20px; text-align: center; transition: all .3s; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05); }
        .instructor-card:hover { border-color: rgba(0,0,0,.2); transform: translateY(-5px); box-shadow: 0 20px 40px rgba(0,0,0,.1); }
        .instructor-avatar { width: 72px; height: 72px; border-radius: 50%; background: linear-gradient(135deg, var(--accent), var(--accent2)); display: flex; align-items: center; justify-content: center; font-size: 26px; font-weight: 700; color: white; margin: 0 auto 14px; }
        .instructor-name { font-size: 15px; font-weight: 700; margin-bottom: 4px; }
        .instructor-spec { font-size: 12px; color: var(--muted); margin-bottom: 14px; }
        .instructor-stats { display: flex; justify-content: center; gap: 20px; }
        .instructor-stat { font-size: 11px; color: var(--muted); text-align: center; }
        .instructor-stat strong { display: block; font-size: 16px; font-weight: 700; color: var(--text); }

        /* FEATURES */
        .features-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; }
        .feature-card { background: var(--card); border: 1px solid var(--border); border-radius: 14px; padding: 28px 24px; transition: all .25s; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05); }
        .feature-card:hover { border-color: rgba(0,0,0,.2); background: var(--surface); box-shadow: 0 10px 20px rgba(0,0,0,.05); }
        .feature-icon { width: 50px; height: 50px; border-radius: 12px; background: rgba(0,0,0,.05); display: flex; align-items: center; justify-content: center; font-size: 20px; color: var(--accent); margin-bottom: 16px; }
        .feature-title { font-size: 15px; font-weight: 700; margin-bottom: 8px; }
        .feature-desc { font-size: 13px; color: var(--muted); line-height: 1.7; }

        /* FOOTER */
        .footer { background: var(--surface); border-top: 1px solid var(--border); padding: 48px 5% 28px; }
        .footer-inner { max-width: 1300px; margin: 0 auto; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 20px; }
        .footer-brand h2 { font-size: 17px; font-weight: 800; }
        .footer-brand p { font-size: 13px; color: var(--muted); margin-top: 4px; }
        .footer-links { display: flex; gap: 20px; }
        .footer-links a { font-size: 13px; color: var(--muted); text-decoration: none; transition: color .2s; }
        .footer-links a:hover { color: var(--text); }
        .footer-bottom { max-width: 1300px; margin: 28px auto 0; padding-top: 20px; border-top: 1px solid var(--border); text-align: center; font-size: 12px; color: var(--muted); }

        /* ANIMATIONS & INTERACTIVE EFFECTS */
        @keyframes fadeInUp { from { opacity:0; transform:translateY(30px); } to { opacity:1; transform:translateY(0); } }
        @keyframes float { 0% { transform: translateY(0px); } 50% { transform: translateY(-10px); } 100% { transform: translateY(0px); } }
        @keyframes pulseGlow { 0% { box-shadow: 0 0 0 0 rgba(0,0,0, 0.4); } 70% { box-shadow: 0 0 0 10px rgba(0,0,0, 0); } 100% { box-shadow: 0 0 0 0 rgba(0,0,0, 0); } }
        
        .animate-in { animation: fadeInUp .6s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
        .delay-1 { animation-delay: .1s; opacity: 0; }
        .delay-2 { animation-delay: .2s; opacity: 0; }
        .delay-3 { animation-delay: .3s; opacity: 0; }
        
        .floating { animation: float 6s ease-in-out infinite; }

        /* DIVIDER */
        .gradient-divider { height: 1px; background: linear-gradient(90deg, transparent, rgba(0,0,0,.1), transparent); margin: 0; }

        /* AUTH MODAL */
        .modal-overlay { position: fixed; inset: 0; background: rgba(255,255,255,0.8); backdrop-filter: blur(10px); z-index: 2000; display: flex; align-items: center; justify-content: center; opacity: 0; pointer-events: none; transition: opacity .3s; }
        .modal-overlay.active { opacity: 1; pointer-events: auto; }
        .auth-modal { background: var(--card); width: 100%; max-width: 420px; border-radius: 24px; padding: 40px; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.15); border: 1px solid var(--border); transform: translateY(30px) scale(0.95); transition: all .4s cubic-bezier(0.16, 1, 0.3, 1); position: relative; }
        .modal-overlay.active .auth-modal { transform: translateY(0) scale(1); }
        .modal-close { position: absolute; top: 20px; right: 20px; background: none; border: none; font-size: 20px; color: var(--muted); cursor: pointer; transition: color .2s; }
        .modal-close:hover { color: var(--text); }
        .auth-title { font-size: 24px; font-weight: 800; text-align: center; margin-bottom: 8px; letter-spacing: -0.5px; }
        .auth-sub { font-size: 14px; color: var(--muted); text-align: center; margin-bottom: 32px; }
        
        .btn-google { display: flex; align-items: center; justify-content: center; gap: 12px; width: 100%; padding: 14px; border-radius: 12px; background: white; border: 1px solid #d1d5db; color: #374151; font-weight: 600; font-size: 15px; cursor: pointer; transition: all .2s; box-shadow: 0 1px 2px rgba(0,0,0,0.05); }
        .btn-google:hover { background: #f9fafb; border-color: #9ca3af; transform: translateY(-1px); box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); }
        .btn-google img { width: 20px; height: 20px; }
        
        .auth-divider { display: flex; align-items: center; text-align: center; margin: 24px 0; color: var(--muted); font-size: 13px; font-weight: 500; }
        .auth-divider::before, .auth-divider::after { content: ''; flex: 1; border-bottom: 1px solid var(--border); }
        .auth-divider::before { margin-right: .5em; }
        .auth-divider::after { margin-left: .5em; }
        
        .auth-input { width: 100%; padding: 14px 16px; border-radius: 12px; border: 1px solid var(--border); background: var(--surface); margin-bottom: 16px; font-size: 14px; font-family: 'Inter', sans-serif; transition: all .2s; outline: none; }
        .auth-input:focus { border-color: var(--accent); background: white; box-shadow: 0 0 0 3px rgba(0,0,0,0.05); }
        
        .auth-submit { width: 100%; padding: 14px; border-radius: 12px; background: var(--accent); color: white; border: none; font-weight: 700; font-size: 15px; cursor: pointer; transition: all .2s; }
        .auth-submit:hover { background: var(--accent2); transform: translateY(-1px); box-shadow: 0 10px 20px -5px rgba(0,0,0,0.2); }
        
        .auth-switch { text-align: center; margin-top: 24px; font-size: 13px; color: var(--muted); }
        .auth-switch a { color: var(--text); font-weight: 600; text-decoration: none; cursor: pointer; }
        .auth-switch a:hover { text-decoration: underline; }

        /* CHATBOT */
        .chatbot-btn { position: fixed; bottom: 30px; right: 30px; width: 60px; height: 60px; border-radius: 50%; background: linear-gradient(135deg, var(--accent), var(--accent2)); color: white; display: flex; align-items: center; justify-content: center; font-size: 24px; cursor: pointer; box-shadow: 0 10px 25px rgba(0,0,0,.2); z-index: 1000; transition: transform .3s; }
        .chatbot-btn:hover { transform: scale(1.05); }
        .chatbot-window { position: fixed; bottom: 100px; right: 30px; width: 350px; height: 450px; background: var(--card); border: 1px solid var(--border); border-radius: 16px; box-shadow: 0 15px 40px rgba(0,0,0,.15); display: flex; flex-direction: column; z-index: 1000; opacity: 0; pointer-events: none; transform: translateY(20px); transition: all .3s cubic-bezier(.4,0,.2,1); overflow: hidden; }
        .chatbot-window.active { opacity: 1; pointer-events: auto; transform: translateY(0); }
        .chatbot-header { background: linear-gradient(135deg, var(--accent), var(--accent2)); color: white; padding: 16px 20px; display: flex; justify-content: space-between; align-items: center; }
        .chatbot-header h3 { font-size: 15px; font-weight: 700; margin: 0; display: flex; align-items: center; gap: 8px; }
        .chatbot-close { background: none; border: none; color: white; cursor: pointer; font-size: 16px; opacity: .8; transition: opacity .2s; }
        .chatbot-close:hover { opacity: 1; }
        .chatbot-body { flex: 1; padding: 20px; overflow-y: auto; display: flex; flex-direction: column; gap: 12px; background: var(--surface); }
        .chat-msg { max-width: 80%; padding: 10px 14px; border-radius: 12px; font-size: 13px; line-height: 1.5; }
        .chat-msg.bot { background: var(--card); border: 1px solid var(--border); border-bottom-left-radius: 2px; align-self: flex-start; }
        .chat-msg.user { background: var(--accent); color: white; border-bottom-right-radius: 2px; align-self: flex-end; }
        .chatbot-input { padding: 14px 20px; background: var(--card); border-top: 1px solid var(--border); display: flex; gap: 10px; }
        .chatbot-input input { flex: 1; border: 1px solid var(--border); border-radius: 20px; padding: 8px 14px; font-size: 13px; outline: none; font-family: 'Inter', sans-serif; transition: border-color .2s; }
        .chatbot-input input:focus { border-color: var(--accent); }
        .chatbot-input button { background: var(--accent); color: white; border: none; width: 34px; height: 34px; border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: transform .2s; }
        .chatbot-input button:hover { transform: scale(1.05); }

        @media (max-width: 992px) {
            .nav { height: 62px; }
            .nav-toggle { display: inline-flex; }
            .nav-links {
                position: fixed;
                top: 62px;
                left: 0;
                right: 0;
                background: rgba(255,255,255,0.98);
                border-bottom: 1px solid var(--border);
                display: none;
                flex-direction: column;
                align-items: stretch;
                padding: 12px;
                gap: 8px;
            }
            .nav-links.open { display: flex; }
            .nav-links a { padding: 10px 12px; }
        }

        @media (max-width: 768px) {
            .features-grid { grid-template-columns: 1fr; }
            .hero-stats { gap: 28px; }
            .chatbot-window { width: calc(100vw - 40px); right: 20px; bottom: 90px; }
        }
    </style>
    @yield('styles')
</head>
<body>
    <nav class="nav">
        <a href="{{ route('home') }}" class="nav-brand">
            <div class="brand-icon"><i class="fas fa-layer-group"></i></div>
            <h1>PanelPro</h1>
        </a>
        <button class="nav-toggle" type="button" onclick="toggleMobileNav()" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>
        <div class="nav-links" id="navLinks">
            <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
            <a href="{{ route('home') }}#about">About Us</a>
            <a href="{{ route('courses') }}" class="{{ request()->routeIs('courses') || request()->routeIs('courses.show') ? 'active' : '' }}">Courses</a>
            <a href="{{ route('instructors') }}" class="{{ request()->routeIs('instructors') ? 'active' : '' }}">Instructors</a>
            <a href="{{ url('chat') }}" class="{{ request()->is('chat') ? 'active' : '' }}">Community Chat</a>
            <a href="{{ url('quiz') }}" class="{{ request()->is('quiz') ? 'active' : '' }}">Quiz</a>
            <a href="{{ route('home') }}#contact" class="nav-cta" style="background: transparent !important; color: #000 !important; border: 1px solid #ccc; margin-right: 8px;">Contact Us</a>
            @auth
                <a href="{{ route('admin.dashboard') }}" class="nav-cta"><i class="fas fa-th-large"></i> Dashboard</a>
            @else
                <a onclick="openAuthModal()" class="nav-cta" style="cursor:pointer;"><i class="fas fa-user-circle"></i> Login</a>
            @endauth
        </div>
    </nav>

    @yield('content')

    <div class="gradient-divider"></div>
    <footer class="footer">
        <div class="footer-inner">
            <div class="footer-brand">
                <h2>PanelPro</h2>
                <p>Empowering education with modern technology.</p>
            </div>
            <div class="footer-links">
                <a href="{{ route('home') }}">Home</a>
                <a href="{{ route('home') }}#about">About Us</a>
                <a href="{{ route('courses') }}">Courses</a>
                <a href="{{ url('chat') }}">Group Chat</a>
                <a href="{{ url('quiz') }}">Quiz</a>
                <a onclick="openAuthModal()" style="cursor:pointer;">Login</a>
            </div>
        </div>
        <div class="footer-bottom">&copy; {{ date('Y') }} PanelPro. All rights reserved.</div>
    </footer>

    <!-- Auth Modal -->
    <div class="modal-overlay" id="authOverlay" onclick="if(event.target===this) closeAuthModal()">
        <div class="auth-modal">
            <button class="modal-close" onclick="closeAuthModal()"><i class="fas fa-times"></i></button>
            <div class="auth-title">Welcome Back</div>
            <div class="auth-sub">Login to your Student or Admin account</div>
            
            <form action="{{ route('admin.login.submit') }}" method="POST">
                @csrf
                <input type="email" name="email" class="auth-input" placeholder="Email address" required>
                <input type="password" name="password" class="auth-input" placeholder="Password" required>
                <button type="submit" class="auth-submit">Login Securely</button>
            </form>
            
            <div class="auth-switch">
                Don't have an account? <a href="{{ route('register') }}">Sign up</a>
            </div>
        </div>
    </div>

    <!-- AI Chatbot UI -->
    <div class="chatbot-btn" onclick="toggleChatbot()">
        <i class="fas fa-robot"></i>
    </div>
    
    <!-- Floating Contact Button -->
    <a href="{{ route('home') }}#contact" class="contact-btn-floating">
        <i class="fas fa-envelope"></i>
    </a>

    <div class="chatbot-window" id="chatbotWindow">
        <div class="chatbot-header">
            <h3><i class="fas fa-robot"></i> PanelAI Assistant</h3>
            <button class="chatbot-close" onclick="toggleChatbot()"><i class="fas fa-times"></i></button>
        </div>
        <div class="chatbot-body" id="chatbotBody">
            <div class="chat-msg bot">Hi there! I'm your AI assistant. How can I help you today?</div>
        </div>
        <form class="chatbot-input" onsubmit="sendAiMessage(event)">
            <input type="text" id="chatbotInput" placeholder="Ask a question..." required autocomplete="off">
            <button type="submit"><i class="fas fa-paper-plane"></i></button>
        </form>
    </div>

    <script>
        // Intersection observer for animations
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                    entry.target.style.transition = 'opacity .6s ease, transform .6s ease';
                }
            });
        }, { threshold: 0.1 });

        document.querySelectorAll('.course-card, .instructor-card, .feature-card, .stat-card').forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(20px)';
            observer.observe(el);
        });

        function toggleMobileNav() {
            document.getElementById('navLinks').classList.toggle('open');
        }

        // Auth Modal Logic
        function openAuthModal() {
            document.getElementById('authOverlay').classList.add('active');
            document.body.style.overflow = 'hidden';
        }
        function closeAuthModal() {
            document.getElementById('authOverlay').classList.remove('active');
            document.body.style.overflow = '';
        }

        // Chatbot Logic
        function toggleChatbot() {
            const win = document.getElementById('chatbotWindow');
            win.classList.toggle('active');
            if(win.classList.contains('active')) document.getElementById('chatbotInput').focus();
        }

        function sendAiMessage(e) {
            e.preventDefault();
            const input = document.getElementById('chatbotInput');
            const msg = input.value.trim();
            if(!msg) return;

            const body = document.getElementById('chatbotBody');
            body.innerHTML += `<div class="chat-msg user">${msg}</div>`;
            input.value = '';
            body.scrollTop = body.scrollHeight;

            // Show typing indicator
            const typingId = 'typing-' + Date.now();
            body.innerHTML += `<div class="chat-msg bot" id="${typingId}"><i class="fas fa-ellipsis-h fa-beat"></i> PanelAI is thinking...</div>`;
            body.scrollTop = body.scrollHeight;

            // Smart AI Response Logic
            setTimeout(() => {
                const typingEl = document.getElementById(typingId);
                if (typingEl) typingEl.remove();

                let reply = "I'm PanelAI, your educational assistant. I'm still learning, but I can help you find courses, navigate the platform, or join the community chat!";
                const lowMsg = msg.toLowerCase();

                if(lowMsg.includes('course') || lowMsg.includes('learn') || lowMsg.includes('study')) {
                    reply = "We offer premium courses in Technology, Business, and Design. You can explore our featured programs on the home page or view the full library in the 'Courses' section.";
                } else if(lowMsg.includes('quiz') || lowMsg.includes('test') || lowMsg.includes('exam')) {
                    reply = "Ready to test your knowledge? Head over to the Quiz section to take interactive challenges and measure your progress!";
                } else if(lowMsg.includes('chat') || lowMsg.includes('community') || lowMsg.includes('group')) {
                    reply = "Join our Community Chat to discuss topics with fellow students and admins. It's the best place to get your doubts cleared!";
                } else if(lowMsg.includes('hello') || lowMsg.includes('hi') || lowMsg.includes('hey')) {
                    reply = "Hello there! I'm your PanelPro assistant. How can I help you advance your career today?";
                } else if(lowMsg.includes('price') || lowMsg.includes('cost') || lowMsg.includes('free')) {
                    reply = "Many of our introductory courses are completely free! Premium courses are priced competitively to ensure high-quality mentorship.";
                } else if(lowMsg.includes('help') || lowMsg.includes('support')) {
                    reply = "If you need technical support, you can use the contact form at the bottom of the page or email us at support@panelpro.com.";
                } else if(lowMsg.includes('login') || lowMsg.includes('signup') || lowMsg.includes('register')) {
                    reply = "You can sign up or log in by clicking the 'Login' button in the top navigation bar. It only takes a minute!";
                }

                body.innerHTML += `<div class="chat-msg bot">${reply}</div>`;
                body.scrollTop = body.scrollHeight;
            }, 1500);
        }
    </script>
    @yield('scripts')
</body>
</html>
