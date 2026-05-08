@extends('layouts.frontend')
@section('title', 'PanelPro CRM — Learn Without Limits')
@section('meta_description', 'Discover world-class courses taught by expert instructors. Join thousands of learners on PanelPro CRM.')

@section('styles')
<style>
    /* Unique Minimalist Hero */
    .hero { min-height: 100vh; display: flex; align-items: center; justify-content: center; position: relative; padding: 120px 5% 60px; overflow: hidden; background: #ffffff; text-align: center; }
    .hero-bg { position: absolute; inset: 0; background: radial-gradient(circle at 50% -20%, rgba(0,0,0,0.03) 0%, transparent 60%); z-index: 0; pointer-events: none; }
    .hero-content { position: relative; z-index: 2; max-width: 900px; display: flex; flex-direction: column; align-items: center; perspective: 1000px; }
    
    .hero-pill { display: inline-flex; align-items: center; gap: 8px; padding: 8px 20px; background: rgba(0,0,0,0.03); border: 1px solid rgba(0,0,0,0.08); border-radius: 40px; font-size: 13px; font-weight: 600; color: #333; margin-bottom: 32px; backdrop-filter: blur(10px); }
    .hero-pill i { color: var(--accent); }
    
    .hero-title { font-size: clamp(48px, 8vw, 84px); font-weight: 900; line-height: 1.05; letter-spacing: -2px; color: #000; margin-bottom: 24px; text-transform: lowercase; }
    .hero-title span { color: transparent; -webkit-text-stroke: 2px #000; }
    
    .hero-desc { font-size: 18px; color: #666; line-height: 1.7; max-width: 600px; margin-bottom: 40px; font-weight: 400; }
    
    /* Stats Bar */
    .minimal-stats { display: flex; gap: 40px; margin-top: 60px; border-top: 1px solid rgba(0,0,0,0.05); padding-top: 40px; justify-content: center; flex-wrap: wrap; }
    .m-stat { text-align: left; display: flex; flex-direction: column; gap: 4px; }
    .m-stat-num { font-size: 36px; font-weight: 800; color: #000; letter-spacing: -1px; }
    .m-stat-label { font-size: 12px; color: #888; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; }

    /* About & Contact Section */
    .creative-section { max-width: 1300px; margin: 0 auto; padding: 100px 5%; display: flex; align-items: center; gap: 60px; flex-wrap: wrap; }
    .creative-section.alt { flex-direction: row-reverse; }
    .cs-content { flex: 1; min-width: 300px; }
    .cs-image { flex: 1; min-width: 300px; height: 400px; background: #f8f9fa; border-radius: 30px; position: relative; overflow: hidden; display: flex; align-items: center; justify-content: center; border: 1px solid #eaeaea; }
    .cs-image::after { content: ''; position: absolute; inset: 0; background: linear-gradient(135deg, transparent, rgba(0,0,0,0.03)); }
    .cs-title { font-size: 40px; font-weight: 900; margin-bottom: 20px; letter-spacing: -1px; }
    .cs-desc { font-size: 16px; color: #666; line-height: 1.8; margin-bottom: 30px; }

    /* Contact form styling */
    .contact-form { width: 100%; max-width: 400px; background: white; padding: 30px; border-radius: 20px; box-shadow: 0 20px 40px rgba(0,0,0,0.05); border: 1px solid #eaeaea; z-index: 10; position: relative; }
    .contact-form input, .contact-form textarea { width: 100%; padding: 14px; margin-bottom: 16px; border-radius: 12px; border: 1px solid #eaeaea; background: #f8f9fa; font-family: 'Inter', sans-serif; outline: none; transition: border 0.2s; }
    .contact-form input:focus, .contact-form textarea:focus { border-color: #000; }

    /* Minimal Courses Grid */
    .minimal-courses { max-width: 1300px; margin: 0 auto; padding: 100px 5%; }
    .mc-header { text-align: center; margin-bottom: 60px; }
    .mc-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 32px; perspective: 1000px; }
    
    .mc-card { background: #fff; border-radius: 20px; padding: 32px; border: 1px solid #f0f0f0; transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1); display: flex; flex-direction: column; text-decoration: none; color: inherit; position: relative; overflow: hidden; transform-style: preserve-3d; }
    .mc-card::before { content: ''; position: absolute; top: 0; left: 0; right: 0; height: 4px; background: #000; transform: scaleX(0); transform-origin: left; transition: transform 0.4s ease; }
    .mc-card:hover { transform: translateY(-8px) rotateX(2deg) rotateY(-2deg); box-shadow: -20px 30px 60px -15px rgba(0,0,0,0.08); border-color: transparent; }
    .mc-card:hover::before { transform: scaleX(1); }
    
    .mc-icon { width: 48px; height: 48px; border-radius: 12px; background: #f8f9fa; display: flex; align-items: center; justify-content: center; font-size: 20px; margin-bottom: 24px; color: #000; transition: all 0.3s; transform: translateZ(20px); }
    .mc-card:hover .mc-icon { background: #000; color: #fff; }
    
    .mc-tag { font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; color: #888; margin-bottom: 12px; transform: translateZ(10px); }
    .mc-title { font-size: 20px; font-weight: 800; color: #000; margin-bottom: 12px; line-height: 1.3; transform: translateZ(30px); }
    .mc-footer { margin-top: auto; padding-top: 24px; border-top: 1px solid #f0f0f0; display: flex; justify-content: space-between; align-items: center; transform: translateZ(10px); }
    .mc-price { font-size: 18px; font-weight: 900; }
</style>
@endsection

@section('content')
    <!-- Hero -->
    <section class="hero">
        <div class="hero-bg"></div>
        <div class="hero-content" data-tilt data-tilt-max="5" data-tilt-speed="400" data-tilt-perspective="1000">
            <div class="hero-pill animate-in delay-1"><i class="fas fa-bolt"></i> The Modern Learning Standard</div>
            <h1 class="hero-title animate-in delay-1">Learn.<br><span>Master.</span> Grow.</h1>
            <p class="hero-desc animate-in delay-2">We stripped away the noise. Just pure, high-quality education, brilliant instructors, and a platform designed to make you strictly better at what you do.</p>
            <div class="hero-btns animate-in delay-2">
                <a href="{{ route('courses') }}" class="btn-hero btn-hero-primary" style="border-radius: 50px; padding: 16px 36px;"><i class="fas fa-play"></i> Start Learning</a>
                <a onclick="openAuthModal()" class="btn-hero btn-hero-ghost" style="border-radius: 50px; padding: 16px 36px; cursor:pointer;"><i class="fas fa-user"></i> Student Sign In</a>
            </div>
            
            <div class="minimal-stats animate-in delay-3">
                <div class="m-stat">
                    <div class="m-stat-num" id="cnt-students">{{ $stats['students'] }}</div>
                    <div class="m-stat-label">Learners</div>
                </div>
                <div class="m-stat">
                    <div class="m-stat-num" id="cnt-courses">{{ $stats['courses'] }}</div>
                    <div class="m-stat-label">Programs</div>
                </div>
                <div class="m-stat">
                    <div class="m-stat-num" id="cnt-instructors">{{ $stats['instructors'] }}</div>
                    <div class="m-stat-label">Experts</div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="creative-section animate-in delay-3" id="about">
        <div class="cs-content">
            <h2 class="cs-title">About PanelPro CRM</h2>
            <p class="cs-desc">We are redefining the educational experience. PanelPro CRM bridges the gap between expert instructors and eager learners. Our platform focuses on an interactive, seamless, and highly engaging design to keep you focused on what matters most—your growth.</p>
            <a href="{{ route('courses') }}" class="btn-hero btn-hero-ghost" style="border-radius: 30px;"><i class="fas fa-info-circle"></i> Discover More</a>
        </div>
        <div class="cs-image" data-tilt data-tilt-max="10" data-tilt-speed="400">
            <i class="fas fa-layer-group floating" style="font-size: 100px; color: #000; opacity: 0.1; position: absolute;"></i>
            <h3 style="font-size: 28px; font-weight: 900; z-index: 2;" class="floating">Innovation in EdTech.</h3>
        </div>
    </section>

    <!-- Minimal Featured Courses -->
    <section class="minimal-courses" id="courses">
        <div class="mc-header">
            <h2 style="font-size: 40px; font-weight: 900; letter-spacing: -1px; margin-bottom: 16px;">Featured Programs</h2>
            <p style="color: #666; font-size: 16px;">Curated paths designed for excellence.</p>
        </div>

        @if($featuredCourses->count() > 0)
            <div class="mc-grid">
                @foreach($featuredCourses as $course)
                    <a href="{{ route('courses.show', $course) }}" class="mc-card" data-tilt data-tilt-max="10" data-tilt-glare="true" data-tilt-max-glare="0.2">
                        <div class="mc-icon">
                            @if($course->category == 'Technology' || $course->category == 'Programming')
                                <i class="fas fa-laptop-code"></i>
                            @elseif($course->category == 'Business')
                                <i class="fas fa-chart-pie"></i>
                            @else
                                <i class="fas fa-book-open"></i>
                            @endif
                        </div>
                        <div class="mc-tag">{{ $course->category }} • {{ $course->level }}</div>
                        <h3 class="mc-title">{{ $course->title }}</h3>
                        <p style="font-size: 14px; color: #666; line-height: 1.6; margin-bottom: 24px; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                            {{ $course->description }}
                        </p>
                        
                        <div class="mc-footer">
                            <div class="mc-price {{ $course->price == 0 ? 'free' : '' }}" style="{{ $course->price == 0 ? 'color: var(--green);' : '' }}">
                                {{ $course->price == 0 ? 'Free' : '₹' . number_format($course->price, 0) }}
                            </div>
                            <div style="font-size: 12px; color: #888; font-weight: 600; display: flex; align-items: center; gap: 6px;">
                                <i class="fas fa-clock"></i> {{ $course->duration_hours }}h
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        @else
            <div style="text-align:center; padding:80px 20px; color:var(--muted);">
                <h3 style="color:var(--text); margin-bottom:8px;">No Courses Yet</h3>
            </div>
        @endif
        
        <div style="text-align: center; margin-top: 60px;">
            <a href="{{ route('courses') }}" class="btn-hero btn-hero-primary" style="background: #000; border-radius: 40px; padding: 14px 32px;">Explore Entire Library <i class="fas fa-arrow-right" style="margin-left: 8px;"></i></a>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="creative-section alt" id="contact" style="background: #fafafa; border-radius: 40px; padding: 60px 5%; margin: 40px 5% 100px;">
        <div class="cs-content" style="padding-left: 40px;">
            <h2 class="cs-title">Get in Touch</h2>
            <p class="cs-desc">Have a question or need assistance? Our support team is here to help you navigate through PanelPro CRM. Drop us a message and we'll get back to you.</p>
            <div style="display:flex; gap: 20px; margin-top: 20px;">
                <div style="display:flex; align-items:center; gap: 10px; font-weight: 600;"><i class="fas fa-envelope"></i> support@panelprocrm.com</div>
                <div style="display:flex; align-items:center; gap: 10px; font-weight: 600;"><i class="fas fa-phone"></i> +91 98765 43210</div>
            </div>
        </div>
        <div class="cs-image" style="background: transparent; border: none; align-items: center;">
            <form class="contact-form floating" onsubmit="event.preventDefault(); alert('Message Sent Successfully!');">
                <h3 style="margin-bottom: 20px; font-size: 20px; font-weight: 800;">Send a Message</h3>
                <input type="text" placeholder="Your Name" required>
                <input type="email" placeholder="Email Address" required>
                <textarea rows="4" placeholder="How can we help?" required></textarea>
                <button type="submit" class="btn-hero btn-hero-primary" style="width: 100%; border-radius: 12px; justify-content: center;">Submit Request</button>
            </form>
        </div>
    </section>

@endsection

@section('scripts')
<!-- Vanilla Tilt JS for 3D Interactive cards -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/vanilla-tilt/1.8.0/vanilla-tilt.min.js"></script>
<script>
    // Stats Counter
    function animateCounter(el) {
        const target = parseInt(el.textContent);
        let count = 0;
        const step = Math.ceil(target / 40) || 1;
        const timer = setInterval(() => {
            count = Math.min(count + step, target);
            el.textContent = count;
            if (count >= target) clearInterval(timer);
        }, 40);
    }
    setTimeout(() => {
        ['cnt-students','cnt-courses','cnt-instructors'].forEach(id => {
            const el = document.getElementById(id);
            if (el) animateCounter(el);
        });
    }, 600);
</script>
@endsection
