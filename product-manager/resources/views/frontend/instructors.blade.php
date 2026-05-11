@extends('layouts.frontend')
@section('title', 'Our Instructors — Edu')
@section('meta_description', 'Meet the expert instructors powering Edu. Learn from the best in their fields.')

@section('content')
    <section style="padding: 100px 5% 60px; max-width: 1300px; margin: 0 auto;">
        <div style="margin-bottom: 52px; text-align: center;">
            <div class="section-label"><i class="fas fa-chalkboard-teacher"></i> Our Faculty</div>
            <h1 class="section-title">Meet Our Instructors</h1>
            <p style="color:var(--muted); font-size:16px; margin-top:12px; max-width:520px; margin-left:auto; margin-right:auto; line-height:1.7;">World-class educators bringing real-world expertise and academic rigor to every course.</p>
        </div>

        @if($instructors->count() > 0)
            <div class="instructors-grid">
                @foreach($instructors as $instructor)
                    <div class="instructor-card">
                        <div class="instructor-avatar">{{ substr($instructor->name, 0, 1) }}</div>
                        <div class="instructor-name">{{ $instructor->name }}</div>
                        <div class="instructor-spec">{{ $instructor->specialization ?? 'Instructor' }}</div>
                        @if($instructor->qualification)
                            <div style="font-size:11px; color:var(--accent); margin-bottom:12px; font-weight:600;">{{ $instructor->qualification }}</div>
                        @endif
                        @if($instructor->bio)
                            <p style="font-size:12px; color:var(--muted); line-height:1.7; margin-bottom:16px;">{{ Str::limit($instructor->bio, 110) }}</p>
                        @endif
                        <div class="instructor-stats">
                            <div class="instructor-stat">
                                <strong>{{ $instructor->experience_years }}</strong>
                                Yrs Exp.
                            </div>
                            <div class="instructor-stat">
                                <strong>{{ $instructor->courses_count }}</strong>
                                Courses
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div style="text-align:center; padding:100px 20px; color:var(--muted);">
                <i class="fas fa-user-slash" style="font-size:60px; margin-bottom:20px; opacity:.2; display:block;"></i>
                <h3 style="color:var(--text); font-size:22px; margin-bottom:10px;">No Instructors Yet</h3>
                <p>Check back soon!</p>
            </div>
        @endif
    </section>
@endsection
