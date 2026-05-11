@extends('layouts.admin')
@section('title', $course->title)
@section('page-title', 'Course Details')
@section('breadcrumb', 'Admin / Courses / Details')

@section('content')
    <div style="display:grid; grid-template-columns:1fr 2fr; gap:20px; align-items:start;">
        <div class="card">
            @if($course->thumbnail)
                <img src="{{ asset('storage/'.$course->thumbnail) }}" alt="{{ $course->title }}" style="width:100%; border-radius:8px; margin-bottom:16px; object-fit:cover; height:180px;">
            @else
                <div style="width:100%; height:140px; border-radius:8px; background:rgba(99,102,241,.1); display:flex; align-items:center; justify-content:center; margin-bottom:16px; font-size:40px; color:var(--accent);">
                    <i class="fas fa-book-open"></i>
                </div>
            @endif
            <h2 style="font-size:17px; font-weight:700; margin-bottom:8px;">{{ $course->title }}</h2>
            <div style="display:flex; gap:6px; flex-wrap:wrap; margin-bottom:12px;">
                <span class="badge badge-purple">{{ $course->category }}</span>
                @if($course->level == 'Beginner')<span class="badge badge-success">Beginner</span>
                @elseif($course->level == 'Intermediate')<span class="badge badge-warning">Intermediate</span>
                @else<span class="badge badge-danger">Advanced</span>@endif
                @if($course->is_featured)<span class="badge badge-info">Featured</span>@endif
            </div>
            <div style="font-size:13px; color:var(--muted); line-height:1.7; margin-bottom:16px;">{{ $course->description }}</div>
            <div style="border-top:1px solid var(--border); padding-top:14px; display:grid; grid-template-columns:1fr 1fr; gap:12px;">
                <div style="text-align:center;">
                    <div style="font-size:20px; font-weight:800; color:var(--green);">Rs. {{ number_format($course->price, 0) }}</div>
                    <div style="font-size:11px; color:var(--muted);">Price</div>
                </div>
                <div style="text-align:center;">
                    <div style="font-size:20px; font-weight:800; color:var(--blue);">{{ $course->duration_hours }}h</div>
                    <div style="font-size:11px; color:var(--muted);">Duration</div>
                </div>
            </div>
            @if($course->instructor)
                <div style="margin-top:14px; padding:12px; background:rgba(255,255,255,.03); border-radius:8px; border:1px solid var(--border);">
                    <div style="font-size:11px; color:var(--muted); margin-bottom:4px;">Instructor</div>
                    <div style="font-size:13.5px; font-weight:600;">{{ $course->instructor->name }}</div>
                    <div style="font-size:12px; color:var(--muted);">{{ $course->instructor->specialization }}</div>
                </div>
            @endif
            <div style="display:flex; gap:8px; margin-top:14px;">
                <a href="{{ route('admin.courses.edit', $course) }}" class="btn btn-warning btn-sm" style="flex:1; justify-content:center;"><i class="fas fa-pen"></i> Edit</a>
                <a href="{{ route('admin.courses.index') }}" class="btn btn-secondary btn-sm" style="flex:1; justify-content:center;"><i class="fas fa-arrow-left"></i> Back</a>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <div class="card-title">Enrolled Students ({{ $course->enrollments->count() }})</div>
                <a href="{{ route('admin.enrollments.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Enroll Student</a>
            </div>
            @if($course->enrollments->count() > 0)
                <table class="data-table">
                    <thead>
                        <tr><th>Student</th><th>Enrolled</th><th>Progress</th><th>Status</th><th>Paid</th></tr>
                    </thead>
                    <tbody>
                        @foreach($course->enrollments as $e)
                            <tr>
                                <td>
                                    <div style="display:flex; align-items:center; gap:8px;">
                                        <div class="avatar" style="width:28px; height:28px; font-size:11px;">{{ substr($e->student->name, 0, 1) }}</div>
                                        <div>
                                            <div style="font-size:13px; font-weight:600;">{{ $e->student->name }}</div>
                                            <div style="font-size:11px; color:var(--muted);">{{ $e->student->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td style="font-size:12px; color:var(--muted);">{{ $e->enrolled_at->format('M d, Y') }}</td>
                                <td>
                                    <div style="display:flex; align-items:center; gap:6px;">
                                        <div class="progress-bar"><div class="progress-fill" style="width:{{ $e->progress }}%;"></div></div>
                                        <span style="font-size:11px; color:var(--muted);">{{ $e->progress }}%</span>
                                    </div>
                                </td>
                                <td>
                                    @if($e->status === 'completed')<span class="badge badge-success">Done</span>
                                    @elseif($e->status === 'active')<span class="badge badge-info">Active</span>
                                    @else<span class="badge badge-danger">Dropped</span>@endif
                                </td>
                                <td style="font-weight:600; color:var(--green);">Rs. {{ number_format($e->amount_paid, 0) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="empty-state">
                    <i class="fas fa-user-graduate"></i>
                    <h3>No Students Yet</h3>
                    <p>Enroll students to this course to get started.</p>
                </div>
            @endif
        </div>
    </div>
@endsection
