@extends('layouts.frontend')
@section('title', 'EduCRM — Learn Without Limits')
@section('meta_description', 'Discover world-class courses taught by expert instructors. Join thousands of learners on EduCRM.')

@section('content')
    <!-- Hero -->
    <section class="hero">
        <div class="hero-bg"></div>
        <div class="hero-grid"></div>
        <div class="hero-content">
            <div class="hero-badge animate-in delay-1"><i class="fas fa-bolt"></i> World-Class Education Platform</div>
            <h1 class="animate-in delay-1">Unlock Your<br>Full Potential</h1>
            <p class="animate-in delay-2">Explore expertly crafted courses across technology, science, arts and more. Learn at your own pace with industry-leading instructors.</p>
            <div class="hero-btns animate-in delay-2">
                <a href="{{ route('courses') }}" class="btn-hero btn-hero-primary"><i class="fas fa-play-circle"></i> Browse Courses</a>
                <a href="{{ route('instructors') }}" class="btn-hero btn-hero-ghost"><i class="fas fa-users"></i> Meet Instructors</a>
            </div>
            <div class="hero-stats animate-in delay-3">
                <div class="hero-stat">
                    <div class="hero-stat-num" id="cnt-students">{{ $stats['students'] }}</div>
                    <div class="hero-stat-label">Students Enrolled</div>
                </div>
                <div class="hero-stat">
                    <div class="hero-stat-num" id="cnt-courses">{{ $stats['courses'] }}</div>
                    <div class="hero-stat-label">Active Courses</div>
                </div>
                <div class="hero-stat">
                    <div class="hero-stat-num" id="cnt-instructors">{{ $stats['instructors'] }}</div>
                    <div class="hero-stat-label">Expert Instructors</div>
                </div>
                <div class="hero-stat">
                    <div class="hero-stat-num" id="cnt-certs">{{ $stats['enrollments'] }}</div>
                    <div class="hero-stat-label">Total Enrollments</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features -->
    <section style="padding: 80px 5%; max-width: 1300px; margin: 0 auto;">
        <div class="section-header center">
            <div class="section-label"><i class="fas fa-star"></i> Why Choose Us</div>
            <h2 class="section-title">Everything You Need to Succeed</h2>
        </div>
        <div class="features-grid">
            @foreach([
                ['fa-brain', 'Expert Instructors', 'Learn from PhDs and industry veterans who bring real-world experience to every lesson.'],
                ['fa-clock', 'Learn at Your Pace', 'Self-paced, structured courses that fit around your schedule — anytime, anywhere.'],
                ['fa-certificate', 'Earn Certificates', 'Complete courses and earn certificates recognized by leading institutions worldwide.'],
                ['fa-comments', 'Interactive Learning', 'Engage in discussions, quizzes, and live sessions with peers and mentors.'],
                ['fa-chart-line', 'Track Progress', 'Detailed progress tracking so you always know where you stand in your learning journey.'],
                ['fa-shield-alt', 'Quality Guaranteed', 'All courses are rigorously reviewed to ensure the highest quality standards.'],
            ] as [$icon, $title, $desc])
                <div class="feature-card">
                    <div class="feature-icon"><i class="fas {{ $icon }}"></i></div>
                    <div class="feature-title">{{ $title }}</div>
                    <div class="feature-desc">{{ $desc }}</div>
                </div>
            @endforeach
        </div>
    </section>

    <div style="height:1px; background:linear-gradient(90deg,transparent,rgba(99,102,241,.2),transparent);"></div>

    <!-- Featured Courses -->
    <section style="padding: 80px 5%; max-width: 1300px; margin: 0 auto;" id="courses">
        <div class="section-header" style="display:flex; justify-content:space-between; align-items:flex-end; flex-wrap:wrap; gap:16px; margin-bottom:40px;">
            <div>
                <div class="section-label"><i class="fas fa-fire"></i> Popular</div>
                <h2 class="section-title" style="margin-bottom:0;">Featured Courses</h2>
            </div>
            <a href="{{ route('courses') }}" class="btn-hero btn-hero-ghost" style="padding:10px 20px; font-size:13px;">View All <i class="fas fa-arrow-right"></i></a>
        </div>

        @if($featuredCourses->count() > 0)
            <div class="courses-grid">
                @foreach($featuredCourses as $course)
                    <a href="{{ route('courses.show', $course) }}" class="course-card">
                        <div class="course-card-img">
                            @if($course->thumbnail)
                                <img src="{{ asset('storage/'.$course->thumbnail) }}" alt="{{ $course->title }}">
                            @else
                                <i class="fas fa-book-open"></i>
                            @endif
                        </div>
                        <div class="course-card-body">
                            <div class="course-meta">
                                <span class="tag tag-purple">{{ $course->category }}</span>
                                @if($course->level === 'Beginner')
                                    <span class="tag tag-green">Beginner</span>
                                @elseif($course->level === 'Intermediate')
                                    <span class="tag tag-orange">Intermediate</span>
                                @else
                                    <span class="tag tag-red">Advanced</span>
                                @endif
                            </div>
                            <div class="course-title">{{ $course->title }}</div>
                            <div class="course-instructor">
                                <i class="fas fa-user-circle" style="margin-right:5px;"></i>
                                {{ $course->instructor?->name ?? 'Expert Instructor' }}
                            </div>
                            <div class="course-footer">
                                <div class="course-price {{ $course->price == 0 ? 'free' : '' }}">
                                    {{ $course->price == 0 ? 'Free' : '$' . number_format($course->price, 0) }}
                                </div>
                                <div class="course-info">
                                    <span><i class="fas fa-clock"></i> {{ $course->duration_hours }}h</span>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        @else
            <div style="text-align:center; padding:80px 20px; color:var(--muted);">
                <i class="fas fa-book-open" style="font-size:48px; margin-bottom:16px; opacity:.3; display:block;"></i>
                <h3 style="color:var(--text); margin-bottom:8px;">No Courses Yet</h3>
                <p>Check back soon — new courses are being added!</p>
            </div>
        @endif
    </section>

    <div style="height:1px; background:linear-gradient(90deg,transparent,rgba(99,102,241,.2),transparent);"></div>

    <!-- Instructors Preview -->
    @if($instructors->count() > 0)
        <section style="padding: 80px 5%; max-width: 1300px; margin: 0 auto;">
            <div class="section-header center">
                <div class="section-label"><i class="fas fa-chalkboard-teacher"></i> Our Team</div>
                <h2 class="section-title">Meet Our Expert Instructors</h2>
                <p class="section-sub" style="margin:0 auto;">Learn from industry professionals and academic experts who are passionate about teaching.</p>
            </div>
            <div class="instructors-grid" style="margin-top:40px;">
                @foreach($instructors as $instructor)
                    <div class="instructor-card">
                        <div class="instructor-avatar">{{ substr($instructor->name, 0, 1) }}</div>
                        <div class="instructor-name">{{ $instructor->name }}</div>
                        <div class="instructor-spec">{{ $instructor->specialization ?? 'Instructor' }}</div>
                        @if($instructor->bio)
                            <p style="font-size:12px; color:var(--muted); line-height:1.6; margin-bottom:16px;">{{ Str::limit($instructor->bio, 90) }}</p>
                        @endif
                        <div class="instructor-stats">
                            <div class="instructor-stat"><strong>{{ $instructor->experience_years }}</strong>Yrs Exp.</div>
                            <div class="instructor-stat"><strong>{{ $instructor->courses_count ?? 0 }}</strong>Courses</div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div style="text-align:center; margin-top:32px;">
                <a href="{{ route('instructors') }}" class="btn-hero btn-hero-ghost" style="font-size:13px; padding:10px 24px;">View All Instructors <i class="fas fa-arrow-right"></i></a>
            </div>
        </section>
    @endif

    <!-- CTA -->
    <section style="padding: 80px 5%;">
        <div style="max-width:1300px; margin:0 auto; background:linear-gradient(135deg, rgba(99,102,241,.15), rgba(139,92,246,.1)); border:1px solid rgba(99,102,241,.2); border-radius:24px; padding:64px 48px; text-align:center;">
            <h2 style="font-size:clamp(26px,3vw,40px); font-weight:800; margin-bottom:14px; letter-spacing:-.5px;">Ready to Start Learning?</h2>
            <p style="font-size:16px; color:var(--muted); margin-bottom:32px; max-width:480px; margin-left:auto; margin-right:auto;">Join thousands of learners already transforming their careers with EduCRM.</p>
            <a href="{{ route('courses') }}" class="btn-hero btn-hero-primary"><i class="fas fa-graduation-cap"></i> Explore All Courses</a>
        </div>
    </section>
@endsection

@section('scripts')
<script>
    // Animated number counter
    function animateCounter(el) {
        const target = parseInt(el.textContent);
        let count = 0;
        const step = Math.ceil(target / 40);
        const timer = setInterval(() => {
            count = Math.min(count + step, target);
            el.textContent = count;
            if (count >= target) clearInterval(timer);
        }, 40);
    }
    setTimeout(() => {
        ['cnt-students','cnt-courses','cnt-instructors','cnt-certs'].forEach(id => {
            const el = document.getElementById(id);
            if (el) animateCounter(el);
        });
    }, 600);
</script>
@endsection
