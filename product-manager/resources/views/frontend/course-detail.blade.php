@extends('layouts.frontend')
@section('title', $course->title . ' — Edu')
@section('meta_description', Str::limit($course->description, 160))

@section('content')
    <section style="padding: 100px 5% 60px; max-width: 1200px; margin: 0 auto;">
        <!-- Breadcrumb -->
        <div style="display:flex; align-items:center; gap:8px; font-size:13px; color:var(--muted); margin-bottom:32px;">
            <a href="{{ route('home') }}" style="color:var(--muted); text-decoration:none; transition:color .2s;" onmouseover="this.style.color='var(--text)'" onmouseout="this.style.color='var(--muted)'">Home</a>
            <i class="fas fa-chevron-right" style="font-size:10px;"></i>
            <a href="{{ route('courses') }}" style="color:var(--muted); text-decoration:none; transition:color .2s;" onmouseover="this.style.color='var(--text)'" onmouseout="this.style.color='var(--muted)'">Courses</a>
            <i class="fas fa-chevron-right" style="font-size:10px;"></i>
            <span style="color:var(--text);">{{ Str::limit($course->title, 40) }}</span>
        </div>

        <div style="display:grid; grid-template-columns:1fr 1fr; gap:48px; align-items:start;">
            <!-- Left: Image + Instructor -->
            <div>
                <div style="width:100%; aspect-ratio:16/10; border-radius:16px; overflow:hidden; background:linear-gradient(135deg, rgba(99,102,241,.2), rgba(139,92,246,.15)); display:flex; align-items:center; justify-content:center; border:1px solid var(--border); margin-bottom:24px;">
                    @if($course->thumbnail)
                        <img src="{{ asset('storage/'.$course->thumbnail) }}" alt="{{ $course->title }}" style="width:100%; height:100%; object-fit:cover;">
                    @else
                        <i class="fas fa-book-open" style="font-size:64px; color:var(--accent);"></i>
                    @endif
                </div>

                @if($course->instructor)
                    <div style="background:var(--card); border:1px solid var(--border); border-radius:14px; padding:20px;">
                        <div style="font-size:11px; font-weight:700; color:var(--muted); text-transform:uppercase; letter-spacing:1px; margin-bottom:12px;">Your Instructor</div>
                        <div style="display:flex; align-items:center; gap:14px;">
                            <div style="width:52px; height:52px; border-radius:50%; background:linear-gradient(135deg,var(--accent),var(--accent2)); display:flex; align-items:center; justify-content:center; font-size:20px; font-weight:700; color:white; flex-shrink:0;">{{ substr($course->instructor->name, 0, 1) }}</div>
                            <div>
                                <div style="font-weight:700; font-size:15px; margin-bottom:3px;">{{ $course->instructor->name }}</div>
                                <div style="font-size:12px; color:var(--muted);">{{ $course->instructor->specialization }}</div>
                                <div style="font-size:12px; color:var(--muted); margin-top:2px;">{{ $course->instructor->qualification }}</div>
                            </div>
                        </div>
                        @if($course->instructor->bio)
                            <p style="font-size:13px; color:var(--muted); line-height:1.7; margin-top:12px; padding-top:12px; border-top:1px solid var(--border);">{{ $course->instructor->bio }}</p>
                        @endif
                    </div>
                @endif
            </div>

            <!-- Right: Details -->
            <div>
                <div style="display:flex; gap:8px; flex-wrap:wrap; margin-bottom:16px;">
                    <span class="tag tag-purple">{{ $course->category }}</span>
                    @if($course->level === 'Beginner')<span class="tag tag-green">Beginner</span>
                    @elseif($course->level === 'Intermediate')<span class="tag tag-orange">Intermediate</span>
                    @else<span class="tag tag-red">Advanced</span>@endif
                    @if($course->is_featured)<span class="tag tag-blue"><i class="fas fa-star" style="font-size:9px;"></i> Featured</span>@endif
                </div>

                <h1 style="font-size:clamp(22px,3vw,34px); font-weight:800; line-height:1.2; margin-bottom:16px; letter-spacing:-.5px;">{{ $course->title }}</h1>

                <div style="font-size:38px; font-weight:900; color:{{ $course->price == 0 ? 'var(--green)' : 'var(--text)' }}; margin-bottom:20px; letter-spacing:-1px;">
                    {{ $course->price == 0 ? 'Free' : 'Rs. '.number_format($course->price, 0) }}
                </div>

                <div style="display:grid; grid-template-columns:1fr 1fr; gap:12px; margin-bottom:24px;">
                    @foreach([
                        ['clock', $course->duration_hours . ' hours', 'Duration'],
                        ['users', $course->enrollments->count() . ' / ' . $course->max_students . ' spots', 'Enrollment Status'],
                        ['calendar-alt', $course->start_date?->format('M d, Y') ?? 'TBA', 'Course Starts'],
                        ['hourglass-end', $course->deadline?->format('M d, Y') ?? 'TBA', 'Apply By'],
                    ] as [$icon, $val, $label])
                        <div style="background:var(--card); border:1px solid var(--border); border-radius:10px; padding:14px;">
                            <div style="font-size:11px; color:var(--muted); margin-bottom:4px; text-transform:uppercase; letter-spacing:.5px;">{{ $label }}</div>
                            <div style="font-weight:700; font-size:14px; display:flex; align-items:center; gap:8px;">
                                <i class="fas fa-{{ $icon }}" style="color:var(--accent); font-size:13px;"></i> {{ $val }}
                            </div>
                        </div>
                    @endforeach
                </div>

                @php
                    $cartService = app(\App\Services\CartService::class);
                    $canEnroll = $cartService->canPurchase($course);
                    $isFull = $course->enrollments->count() >= $course->max_students;
                    $deadlinePassed = $course->deadline && $course->deadline->isPast();
                @endphp

                @if($isFull)
                    <div style="background:rgba(239,68,68,.1); color:var(--red); padding:12px; border-radius:8px; font-size:13px; font-weight:600; margin-bottom:20px;">
                        <i class="fas fa-exclamation-circle"></i> This course has reached its maximum capacity of {{ $course->max_students }} students.
                    </div>
                @elseif($deadlinePassed)
                    <div style="background:rgba(239,68,68,.1); color:var(--red); padding:12px; border-radius:8px; font-size:13px; font-weight:600; margin-bottom:20px;">
                        <i class="fas fa-clock"></i> The enrollment deadline for this course has passed.
                    </div>
                @endif

                @if($course->description)
                    <div style="font-size:14px; color:var(--muted); line-height:1.8; margin-bottom:28px; padding-bottom:24px; border-bottom:1px solid var(--border);">
                        {{ $course->description }}
                    </div>
                @endif

                <div style="display:flex; gap:12px; flex-wrap:wrap; align-items:center;">
                    @if($canEnroll)
                        @include('partials.add-to-cart', ['course' => $course])
                    @else
                        <button class="btn-hero btn-hero-primary" style="opacity: 0.5; cursor: not-allowed;" disabled>
                            <i class="fas fa-ban"></i> Enrollment Closed
                        </button>
                    @endif
                    @auth
                        @if(auth()->user()->isStudent())
                            <a href="{{ route('student.cart.index') }}" class="btn-hero btn-hero-ghost">
                                <i class="fas fa-shopping-cart"></i> View Cart
                            </a>
                        @endif
                    @endauth
                    <a href="{{ route('courses') }}" class="btn-hero btn-hero-ghost">
                        <i class="fas fa-arrow-left"></i> Back to Courses
                    </a>
                </div>
            </div>
        </div>

        <!-- Related Courses -->
        @if($related->count() > 0)
            <div style="margin-top: 72px;">
                <div class="section-label" style="margin-bottom:14px;"><i class="fas fa-layer-group"></i> More Like This</div>
                <h2 style="font-size:24px; font-weight:800; margin-bottom:32px;">Related Courses</h2>
                <div class="courses-grid">
                    @foreach($related as $r)
                        <a href="{{ route('courses.show', $r) }}" class="course-card">
                            <div class="course-card-img">
                                @if($r->thumbnail)
                                    <img src="{{ asset('storage/'.$r->thumbnail) }}" alt="{{ $r->title }}">
                                @else
                                    <i class="fas fa-book-open"></i>
                                @endif
                            </div>
                            <div class="course-card-body">
                                <div class="course-meta">
                                    <span class="tag tag-purple">{{ $r->category }}</span>
                                </div>
                                <div class="course-title">{{ $r->title }}</div>
                                <div class="course-footer">
                                    <div class="course-price {{ $r->price == 0 ? 'free' : '' }}">{{ $r->price == 0 ? 'Free' : 'Rs. '.number_format($r->price, 0) }}</div>
                                    <div class="course-info"><span><i class="fas fa-clock"></i> {{ $r->duration_hours }}h</span></div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    </section>
@endsection
