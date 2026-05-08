@extends('layouts.frontend')
@section('title', 'Browse Courses — EduCRM')
@section('meta_description', 'Browse all available courses on EduCRM. Filter by category, level, and more.')

@section('content')
    <section style="padding: 100px 5% 60px; max-width: 1300px; margin: 0 auto;">
        <div style="margin-bottom: 40px;">
            <div class="section-label"><i class="fas fa-book-open"></i> Learning Library</div>
            <h1 class="section-title">Explore All Courses</h1>
            <p style="color:var(--muted); font-size:15px; margin-top:8px;">{{ $courses->total() }} courses available</p>
        </div>

        <!-- Filters -->
        <form method="GET" style="display:flex; gap:10px; flex-wrap:wrap; margin-bottom:36px;">
            <div style="position:relative; flex:1; min-width:220px;">
                <i class="fas fa-search" style="position:absolute; left:14px; top:50%; transform:translateY(-50%); color:var(--muted); font-size:13px;"></i>
                <input type="text" name="search" value="{{ request('search') }}"
                    style="width:100%; padding:11px 14px 11px 38px; background:var(--card); border:1px solid var(--border); border-radius:10px; color:var(--text); font-size:14px; font-family:'Inter',sans-serif; outline:none; transition:border .2s;"
                    placeholder="Search courses..." onfocus="this.style.borderColor='var(--accent)'" onblur="this.style.borderColor='var(--border)'">
            </div>
            <select name="category" style="padding:11px 14px; background:var(--card); border:1px solid var(--border); border-radius:10px; color:var(--text); font-size:14px; font-family:'Inter',sans-serif; cursor:pointer; min-width:160px; outline:none;">
                <option value="">All Categories</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                @endforeach
            </select>
            <select name="level" style="padding:11px 14px; background:var(--card); border:1px solid var(--border); border-radius:10px; color:var(--text); font-size:14px; font-family:'Inter',sans-serif; cursor:pointer; min-width:140px; outline:none;">
                <option value="">All Levels</option>
                <option value="Beginner" {{ request('level') == 'Beginner' ? 'selected' : '' }}>Beginner</option>
                <option value="Intermediate" {{ request('level') == 'Intermediate' ? 'selected' : '' }}>Intermediate</option>
                <option value="Advanced" {{ request('level') == 'Advanced' ? 'selected' : '' }}>Advanced</option>
            </select>
            <button type="submit" class="btn-hero btn-hero-primary" style="padding:11px 22px; font-size:13px;"><i class="fas fa-filter"></i> Filter</button>
            @if(request()->hasAny(['search','category','level']))
                <a href="{{ route('courses') }}" class="btn-hero btn-hero-ghost" style="padding:11px 18px; font-size:13px;">Clear</a>
            @endif
        </form>

        <!-- Grid -->
        @if($courses->count() > 0)
            <div class="courses-grid">
                @foreach($courses as $course)
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
                                @if($course->level === 'Beginner')<span class="tag tag-green">Beginner</span>
                                @elseif($course->level === 'Intermediate')<span class="tag tag-orange">Intermediate</span>
                                @else<span class="tag tag-red">Advanced</span>@endif
                            </div>
                            <div class="course-title">{{ $course->title }}</div>
                            <div class="course-instructor"><i class="fas fa-user-circle" style="margin-right:5px;"></i>{{ $course->instructor?->name ?? 'Expert Instructor' }}</div>
                            <div class="course-footer">
                                <div class="course-price {{ $course->price == 0 ? 'free' : '' }}">{{ $course->price == 0 ? 'Free' : '$'.number_format($course->price, 0) }}</div>
                                <div class="course-info">
                                    <span><i class="fas fa-clock"></i> {{ $course->duration_hours }}h</span>
                                    <span><i class="fas fa-users"></i> {{ $course->enrollments_count }}</span>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

            <!-- Pagination -->
            @if($courses->hasPages())
                <div style="display:flex; justify-content:center; margin-top:48px;">
                    {{ $courses->links() }}
                </div>
            @endif
        @else
            <div style="text-align:center; padding:100px 20px; color:var(--muted);">
                <i class="fas fa-book-open" style="font-size:60px; margin-bottom:20px; opacity:.2; display:block; color:var(--accent);"></i>
                <h3 style="color:var(--text); font-size:22px; margin-bottom:10px;">No Courses Found</h3>
                <p>Try adjusting your filters.</p>
                <a href="{{ route('courses') }}" class="btn-hero btn-hero-ghost" style="margin-top:20px; font-size:13px; padding:10px 22px; display:inline-flex;">Clear Filters</a>
            </div>
        @endif
    </section>
@endsection
