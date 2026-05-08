@extends('layouts.admin')
@section('title', $student->name)
@section('page-title', 'Student Profile')
@section('breadcrumb', 'Admin / Students / Profile')

@section('content')
    <div style="display:grid; grid-template-columns:1fr 2fr; gap:20px;">
        <!-- Profile Card -->
        <div class="card" style="height:fit-content; text-align:center;">
            <div class="avatar" style="width:70px; height:70px; font-size:28px; margin: 0 auto 16px;">{{ substr($student->name, 0, 1) }}</div>
            <h2 style="font-size:18px; font-weight:700; margin-bottom:4px;">{{ $student->name }}</h2>
            <div style="font-size:12px; color:var(--muted); font-family:monospace; margin-bottom:12px;">{{ $student->student_id }}</div>
            @if($student->status === 'active')
                <span class="badge badge-success">Active</span>
            @elseif($student->status === 'inactive')
                <span class="badge badge-warning">Inactive</span>
            @else
                <span class="badge badge-danger">Suspended</span>
            @endif
            <div style="margin-top:20px; border-top:1px solid var(--border); padding-top:16px; text-align:left;">
                @if($student->email)
                    <div style="display:flex; align-items:center; gap:10px; margin-bottom:12px; font-size:13px;">
                        <i class="fas fa-envelope" style="color:var(--muted); width:16px;"></i>
                        <span style="color:var(--text);">{{ $student->email }}</span>
                    </div>
                @endif
                @if($student->phone)
                    <div style="display:flex; align-items:center; gap:10px; margin-bottom:12px; font-size:13px;">
                        <i class="fas fa-phone" style="color:var(--muted); width:16px;"></i>
                        <span style="color:var(--text);">{{ $student->phone }}</span>
                    </div>
                @endif
                @if($student->gender)
                    <div style="display:flex; align-items:center; gap:10px; margin-bottom:12px; font-size:13px;">
                        <i class="fas fa-venus-mars" style="color:var(--muted); width:16px;"></i>
                        <span style="color:var(--text); text-transform:capitalize;">{{ $student->gender }}</span>
                    </div>
                @endif
                @if($student->date_of_birth)
                    <div style="display:flex; align-items:center; gap:10px; margin-bottom:12px; font-size:13px;">
                        <i class="fas fa-birthday-cake" style="color:var(--muted); width:16px;"></i>
                        <span style="color:var(--text);">{{ $student->date_of_birth->format('M d, Y') }}</span>
                    </div>
                @endif
            </div>
            <div style="display:flex; gap:8px; margin-top:12px;">
                <a href="{{ route('admin.students.edit', $student) }}" class="btn btn-warning btn-sm" style="flex:1; justify-content:center;"><i class="fas fa-pen"></i> Edit</a>
                <a href="{{ route('admin.students.index') }}" class="btn btn-secondary btn-sm" style="flex:1; justify-content:center;"><i class="fas fa-arrow-left"></i> Back</a>
            </div>
        </div>

        <!-- Enrollments -->
        <div class="card">
            <div class="card-header">
                <div class="card-title">Enrolled Courses ({{ $student->enrollments->count() }})</div>
                <a href="{{ route('admin.enrollments.create') }}?student_id={{ $student->id }}" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Enroll</a>
            </div>
            @if($student->enrollments->count() > 0)
                <table class="data-table">
                    <thead>
                        <tr><th>Course</th><th>Instructor</th><th>Progress</th><th>Status</th><th>Date</th></tr>
                    </thead>
                    <tbody>
                        @foreach($student->enrollments as $e)
                            <tr>
                                <td style="font-weight:600; font-size:13.5px;">{{ $e->course->title }}</td>
                                <td style="font-size:12px; color:var(--muted);">{{ $e->course->instructor?->name ?? '—' }}</td>
                                <td>
                                    <div style="display:flex; align-items:center; gap:8px;">
                                        <div class="progress-bar" style="width:80px;"><div class="progress-fill" style="width:{{ $e->progress }}%;"></div></div>
                                        <span style="font-size:11px; color:var(--muted);">{{ $e->progress }}%</span>
                                    </div>
                                </td>
                                <td>
                                    @if($e->status === 'completed')
                                        <span class="badge badge-success">Completed</span>
                                    @elseif($e->status === 'active')
                                        <span class="badge badge-info">Active</span>
                                    @else
                                        <span class="badge badge-danger">Dropped</span>
                                    @endif
                                </td>
                                <td style="font-size:12px; color:var(--muted);">{{ $e->enrolled_at->format('M d, Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="empty-state">
                    <i class="fas fa-book-open"></i>
                    <h3>Not Enrolled Yet</h3>
                    <p>Enroll this student in a course to get started.</p>
                </div>
            @endif
        </div>
    </div>
@endsection
