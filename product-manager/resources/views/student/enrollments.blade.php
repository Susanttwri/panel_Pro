@extends('layouts.student')
@section('title', 'My Courses — PanelPro Student')

@section('content')
    <h1 class="page-title">My Courses</h1>
    <p class="page-sub">Courses you are enrolled in.</p>

    @if($enrollments->count() > 0)
        <div style="display:grid; gap:14px;">
            @foreach($enrollments as $e)
                <div style="background:var(--card); border:1px solid var(--border); border-radius:14px; padding:24px;">
                    <div style="display:flex; justify-content:space-between; align-items:flex-start; flex-wrap:wrap; gap:12px; margin-bottom:16px;">
                        <div>
                            <h3 style="font-size:17px; font-weight:700;">{{ $e->course->title }}</h3>
                            <p style="font-size:13px; color:var(--muted); margin-top:4px;">
                                {{ $e->course->category }} · {{ $e->course->instructor?->name }} ·
                                Enrolled {{ $e->enrolled_at?->format('M d, Y') }}
                            </p>
                        </div>
                        <span style="font-size:12px; font-weight:600; color:#059669;">{{ ucfirst($e->status) }}</span>
                    </div>
                    @include('partials.course-progress', ['enrollment' => $e])
                    <div style="display:flex; gap:10px; flex-wrap:wrap; margin-top:16px;">
                        <a href="{{ route('student.enrollment.show', $e) }}" class="btn btn-primary" style="font-size:13px;"><i class="fas fa-book-open"></i> Open Course</a>
                        <a href="{{ route('student.quiz.show', $e) }}" class="btn btn-ghost" style="font-size:13px;"><i class="fas fa-clipboard-question"></i> Quiz</a>
                    </div>
                </div>
            @endforeach
        </div>
        <div style="margin-top:28px;">{{ $enrollments->links() }}</div>
    @else
        <div style="text-align:center; padding:60px 20px; background:var(--card); border:1px dashed var(--border); border-radius:14px;">
            <i class="fas fa-book-open" style="font-size:48px; color:var(--muted); opacity:.3;"></i>
            <p style="margin:16px 0 24px; color:var(--muted);">You are not enrolled in any courses yet.</p>
            <a href="{{ route('student.courses') }}" class="btn btn-primary">Browse Courses</a>
        </div>
    @endif
@endsection
