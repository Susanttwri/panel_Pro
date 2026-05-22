@extends('layouts.student')
@section('title', 'Browse Courses — PanelPro Student')

@section('content')
    <h1 class="page-title">Browse Courses</h1>
    <p class="page-sub">Select courses and add them to your cart to enroll.</p>

    <form method="GET" style="display:flex; gap:10px; flex-wrap:wrap; margin-bottom:28px;">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search courses..." style="flex:1; min-width:200px; padding:10px 14px; border:1px solid var(--border); border-radius:8px;">
        <select name="category" style="padding:10px 14px; border:1px solid var(--border); border-radius:8px;">
            <option value="">All Categories</option>
            @foreach($categories as $cat)
                <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
            @endforeach
        </select>
        <select name="level" style="padding:10px 14px; border:1px solid var(--border); border-radius:8px;">
            <option value="">All Levels</option>
            <option value="Beginner" {{ request('level') == 'Beginner' ? 'selected' : '' }}>Beginner</option>
            <option value="Intermediate" {{ request('level') == 'Intermediate' ? 'selected' : '' }}>Intermediate</option>
            <option value="Advanced" {{ request('level') == 'Advanced' ? 'selected' : '' }}>Advanced</option>
        </select>
        <button type="submit" class="btn btn-primary">Filter</button>
    </form>

    @if($courses->count() > 0)
        <div style="display:grid; grid-template-columns:repeat(auto-fill,minmax(300px,1fr)); gap:20px;">
            @foreach($courses as $course)
                <div style="background:var(--card); border:1px solid var(--border); border-radius:14px; padding:22px; display:flex; flex-direction:column;">
                    <span style="font-size:11px; font-weight:600; color:var(--muted);">{{ $course->category }} · {{ $course->level }}</span>
                    <h3 style="font-size:17px; font-weight:700; margin:10px 0 8px;">{{ $course->title }}</h3>
                    <p style="font-size:13px; color:var(--muted); flex:1; margin-bottom:12px;">{{ Str::limit($course->description, 100) }}</p>
                    <div style="font-size:12px; color:var(--muted); margin-bottom:14px;">
                        <i class="fas fa-user"></i> {{ $course->instructor?->name ?? 'Instructor' }} ·
                        {{ $course->enrollments_count }}/{{ $course->max_students }} enrolled ·
                        {{ $course->duration_hours }}h
                    </div>
                    <div style="display:flex; justify-content:space-between; align-items:center; border-top:1px solid var(--border); padding-top:14px;">
                        <span style="font-size:20px; font-weight:800;">{{ $course->price == 0 ? 'Free' : 'Rs. '.number_format($course->price,0) }}</span>
                        @include('partials.add-to-cart', ['course' => $course])
                    </div>
                </div>
            @endforeach
        </div>
        <div style="margin-top:32px;">{{ $courses->links() }}</div>
    @else
        <p style="color:var(--muted);">No courses found. Try different filters.</p>
    @endif
@endsection
