@extends('layouts.frontend')
@section('title', 'EduCRM — Learn Without Limits')
@section('meta_description', 'Discover world-class courses taught by expert instructors. Join thousands of learners on EduCRM.')

@section('styles')
<style>
    /* Unique Minimalist Hero */
    .hero { min-height: 100vh; display: flex; align-items: center; justify-content: center; position: relative; padding: 120px 5% 60px; overflow: hidden; background: #ffffff; text-align: center; }
    .hero-bg { position: absolute; inset: 0; background: radial-gradient(circle at 50% -20%, rgba(0,0,0,0.03) 0%, transparent 60%); z-index: 0; pointer-events: none; }
    .hero-content { position: relative; z-index: 2; max-width: 900px; display: flex; flex-direction: column; align-items: center; }
    
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

    /* Contribution Graph Feature */
    .contribution-section { max-width: 1100px; margin: 0 auto; padding: 80px 5%; position: relative; z-index: 2; }
    .c-card { background: #fff; border: 1px solid #eaeaea; border-radius: 24px; padding: 48px; box-shadow: 0 40px 80px -20px rgba(0,0,0,0.08); position: relative; overflow: hidden; display: flex; flex-direction: column; gap: 32px; }
    
    .c-header { display: flex; justify-content: space-between; align-items: flex-end; flex-wrap: wrap; gap: 20px; }
    .c-title { font-size: 24px; font-weight: 800; letter-spacing: -0.5px; color: #000; display: flex; align-items: center; gap: 12px; }
    .c-title i { color: var(--green); }
    .c-subtitle { font-size: 14px; color: #666; margin-top: 4px; }
    
    /* The Creative Graph Grid */
    .graph-container { display: flex; gap: 6px; overflow-x: auto; padding-bottom: 12px; }
    .graph-col { display: flex; flex-direction: column; gap: 6px; }
    .graph-dot { width: 14px; height: 14px; border-radius: 50%; background: #f3f4f6; transition: all 0.3s ease; position: relative; cursor: pointer; }
    .graph-dot:hover { transform: scale(1.4); z-index: 10; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
    
    .level-1 { background: #d1fae5; }
    .level-2 { background: #6ee7b7; box-shadow: 0 0 10px rgba(110,231,183,0.4); }
    .level-3 { background: #10b981; box-shadow: 0 0 15px rgba(16,185,129,0.5); }
    .level-4 { background: #047857; box-shadow: 0 0 20px rgba(4,120,87,0.6); }

    .graph-tooltip { position: absolute; bottom: 100%; left: 50%; transform: translateX(-50%) translateY(-8px); background: #000; color: #fff; padding: 6px 10px; border-radius: 6px; font-size: 11px; white-space: nowrap; pointer-events: none; opacity: 0; transition: all 0.2s; font-weight: 600; }
    .graph-dot:hover .graph-tooltip { opacity: 1; transform: translateX(-50%) translateY(-12px); }

    /* Minimal Courses Grid */
    .minimal-courses { max-width: 1300px; margin: 0 auto; padding: 100px 5%; }
    .mc-header { text-align: center; margin-bottom: 60px; }
    .mc-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 32px; }
    
    .mc-card { background: #fff; border-radius: 20px; padding: 32px; border: 1px solid #f0f0f0; transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1); display: flex; flex-direction: column; text-decoration: none; color: inherit; position: relative; overflow: hidden; }
    .mc-card::before { content: ''; position: absolute; top: 0; left: 0; right: 0; height: 4px; background: #000; transform: scaleX(0); transform-origin: left; transition: transform 0.4s ease; }
    .mc-card:hover { transform: translateY(-8px); box-shadow: 0 30px 60px -15px rgba(0,0,0,0.08); border-color: transparent; }
    .mc-card:hover::before { transform: scaleX(1); }
    
    .mc-icon { width: 48px; height: 48px; border-radius: 12px; background: #f8f9fa; display: flex; align-items: center; justify-content: center; font-size: 20px; margin-bottom: 24px; color: #000; transition: all 0.3s; }
    .mc-card:hover .mc-icon { background: #000; color: #fff; }
    
    .mc-tag { font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; color: #888; margin-bottom: 12px; }
    .mc-title { font-size: 20px; font-weight: 800; color: #000; margin-bottom: 12px; line-height: 1.3; }
    .mc-footer { margin-top: auto; padding-top: 24px; border-top: 1px solid #f0f0f0; display: flex; justify-content: space-between; align-items: center; }
    .mc-price { font-size: 18px; font-weight: 900; }
</style>
@endsection

@section('content')
    <!-- Hero -->
    <section class="hero">
        <div class="hero-bg"></div>
        <div class="hero-content">
            <div class="hero-pill animate-in delay-1"><i class="fas fa-bolt"></i> The Modern Learning Standard</div>
            <h1 class="hero-title animate-in delay-1">Learn.<br><span>Master.</span> Grow.</h1>
            <p class="hero-desc animate-in delay-2">We stripped away the noise. Just pure, high-quality education, brilliant instructors, and a platform designed to make you strictly better at what you do.</p>
            <div class="hero-btns animate-in delay-2">
                <a href="{{ route('courses') }}" class="btn-hero btn-hero-primary" style="border-radius: 50px; padding: 16px 36px;"><i class="fas fa-play"></i> Start Learning</a>
                <a onclick="openAuthModal()" class="btn-hero btn-hero-ghost" style="border-radius: 50px; padding: 16px 36px; cursor:pointer;"><i class="fab fa-google"></i> Student Sign In</a>
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

    <!-- Contribution Graph Section -->
    <section class="contribution-section animate-in delay-3">
        <div class="c-card">
            <div class="c-header">
                <div>
                    <h2 class="c-title"><i class="fas fa-fire-alt"></i> Your Learning Activity</h2>
                    <p class="c-subtitle">Track your daily progress, quizzes taken, and modules completed.</p>
                </div>
                <div style="display:flex; gap: 12px; align-items:center; font-size:12px; color:#666; font-weight:600;">
                    Less
                    <div style="display:flex; gap:4px;">
                        <div class="graph-dot"></div>
                        <div class="graph-dot level-1"></div>
                        <div class="graph-dot level-2"></div>
                        <div class="graph-dot level-3"></div>
                        <div class="graph-dot level-4"></div>
                    </div>
                    More
                </div>
            </div>
            
            <div class="graph-container" id="activity-graph">
                <!-- JS Generated Graph -->
            </div>
            
            <div style="display: flex; gap: 24px; border-top: 1px solid #f0f0f0; padding-top: 24px;">
                <div>
                    <div style="font-size: 24px; font-weight: 800; color: #000;">143</div>
                    <div style="font-size: 12px; color: #888; font-weight: 600; text-transform: uppercase;">Total Contributions</div>
                </div>
                <div>
                    <div style="font-size: 24px; font-weight: 800; color: #000;">12</div>
                    <div style="font-size: 12px; color: #888; font-weight: 600; text-transform: uppercase;">Current Streak</div>
                </div>
            </div>
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
                    <a href="{{ route('courses.show', $course) }}" class="mc-card">
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
                                {{ $course->price == 0 ? 'Free' : '$' . number_format($course->price, 0) }}
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
@endsection

@section('scripts')
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

    // Generate Creative Contribution Graph
    const graphContainer = document.getElementById('activity-graph');
    const cols = 52; // Weeks
    const rows = 7; // Days

    for (let c = 0; c < cols; c++) {
        const colDiv = document.createElement('div');
        colDiv.className = 'graph-col';
        
        for (let r = 0; r < rows; r++) {
            const dot = document.createElement('div');
            dot.className = 'graph-dot';
            
            // Generate random activity level for demo, weighted towards recent weeks
            let activity = 0;
            const rand = Math.random();
            
            // Simulate recent activity (right side of graph)
            if (c > 30 && rand > 0.4) activity = 1;
            if (c > 40 && rand > 0.6) activity = 2;
            if (c > 45 && rand > 0.7) activity = 3;
            if (c > 48 && rand > 0.8) activity = 4;
            
            // Sparse past activity
            if (c <= 30 && rand > 0.85) activity = 1;
            if (c <= 30 && rand > 0.95) activity = 2;

            if (activity > 0) {
                dot.classList.add(`level-${activity}`);
            }

            // Tooltip
            const tooltip = document.createElement('div');
            tooltip.className = 'graph-tooltip';
            const contributions = activity === 0 ? 'No' : (activity * 2 + Math.floor(Math.random()*3));
            tooltip.innerText = `${contributions} contributions on this day`;
            
            dot.appendChild(tooltip);
            colDiv.appendChild(dot);
        }
        graphContainer.appendChild(colDiv);
    }
    
    // Auto-scroll graph to the right (most recent)
    graphContainer.scrollLeft = graphContainer.scrollWidth;
</script>
@endsection
