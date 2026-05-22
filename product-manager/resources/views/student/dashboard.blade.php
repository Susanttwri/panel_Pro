@extends('layouts.student')
@section('title', 'Dashboard — PanelPro Student')

@section('content')
    <h1 class="page-title">Welcome, {{ auth()->user()->name }}!</h1>
    <p class="page-sub">Track progress on enrolled courses, take course quizzes, and continue learning from your dashboard.</p>

    <div style="display:grid; grid-template-columns:repeat(auto-fit,minmax(200px,1fr)); gap:16px; margin-bottom:32px;">
        <div style="background:var(--card); border:1px solid var(--border); border-radius:14px; padding:24px;">
            <div style="font-size:13px; color:var(--muted);">Enrolled Courses</div>
            <div style="font-size:32px; font-weight:800; margin-top:8px;">{{ $enrolledCount }}</div>
        </div>
        <div style="background:var(--card); border:1px solid var(--border); border-radius:14px; padding:24px;">
            <div style="font-size:13px; color:var(--muted);">Cart Items</div>
            <div style="font-size:32px; font-weight:800; margin-top:8px;">{{ $cartCount }}</div>
        </div>
        <div style="background:var(--card); border:1px solid var(--border); border-radius:14px; padding:24px;">
            <div style="font-size:13px; color:var(--muted);">Cart Total</div>
            <div style="font-size:32px; font-weight:800; margin-top:8px;">Rs. {{ number_format($cartTotal, 0) }}</div>
        </div>
    </div>

    <div style="display:flex; gap:12px; flex-wrap:wrap; margin-bottom:36px;">
        <a href="{{ route('student.courses') }}" class="btn btn-primary"><i class="fas fa-book-open"></i> Browse All Courses</a>
        <a href="{{ route('student.cart.index') }}" class="btn btn-ghost"><i class="fas fa-shopping-cart"></i> View Cart ({{ $cartCount }})</a>
        <a href="{{ route('student.enrollments') }}" class="btn btn-ghost"><i class="fas fa-graduation-cap"></i> My Courses</a>
    </div>

    @if($enrollments->count() > 0)
        <h2 style="font-size:18px; font-weight:700; margin-bottom:16px;">Recent Enrollments</h2>
        <div style="display:grid; gap:12px;">
            @foreach($enrollments as $e)
                <div style="background:var(--card); border:1px solid var(--border); border-radius:12px; padding:20px 24px;">
                    <div style="display:flex; justify-content:space-between; align-items:flex-start; flex-wrap:wrap; gap:12px; margin-bottom:14px;">
                        <div>
                            <div style="font-weight:700; font-size:16px;">{{ $e->course->title }}</div>
                            <div style="font-size:12px; color:var(--muted); margin-top:4px;">{{ $e->course->category }} · Enrolled {{ $e->enrolled_at?->format('M d, Y') }}</div>
                        </div>
                        <span style="font-size:12px; font-weight:600; color:#059669;">{{ ucfirst($e->status) }}</span>
                    </div>
                    @include('partials.course-progress', ['enrollment' => $e])
                    <div style="display:flex; gap:10px; flex-wrap:wrap; margin-top:16px;">
                        <a href="{{ route('student.enrollment.show', $e) }}" class="btn btn-primary" style="font-size:13px; padding:8px 14px;"><i class="fas fa-play"></i> Continue</a>
                        <a href="{{ route('student.quiz.show', $e) }}" class="btn btn-ghost" style="font-size:13px; padding:8px 14px;"><i class="fas fa-clipboard-question"></i> Take Quiz</a>
                    </div>
                </div>
            @endforeach
        </div>
        <a href="{{ route('student.enrollments') }}" style="display:inline-block; margin-top:16px; font-size:14px; color:var(--muted);">View all enrollments →</a>
    @endif

    <h2 style="font-size:18px; font-weight:700; margin:36px 0 16px;">Available Courses</h2>
    <div style="display:grid; grid-template-columns:repeat(auto-fill,minmax(280px,1fr)); gap:20px;">
        @foreach($featuredCourses as $course)
            <div style="background:var(--card); border:1px solid var(--border); border-radius:14px; padding:20px;">
                <div style="font-size:11px; font-weight:600; color:var(--muted); text-transform:uppercase;">{{ $course->category }}</div>
                <h3 style="font-size:16px; font-weight:700; margin:8px 0;">{{ $course->title }}</h3>
                <p style="font-size:13px; color:var(--muted); margin-bottom:12px;">{{ $course->duration_hours }}h · {{ $course->level }}</p>
                <div style="display:flex; justify-content:space-between; align-items:center;">
                    <span style="font-weight:800;">{{ $course->price == 0 ? 'Free' : 'Rs. '.number_format($course->price,0) }}</span>
                    @include('partials.add-to-cart', ['course' => $course])
                </div>
            </div>
        @endforeach
    </div>
@endsection
