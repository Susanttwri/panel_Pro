@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('breadcrumb', 'Admin / Dashboard')

@section('content')
    <!-- Stats -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon purple"><i class="fas fa-user-graduate"></i></div>
            <div class="stat-info">
                <h3>{{ number_format($stats['students']) }}</h3>
                <p>Total Students</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon blue"><i class="fas fa-book-open"></i></div>
            <div class="stat-info">
                <h3>{{ number_format($stats['courses']) }}</h3>
                <p>Active Courses</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon orange"><i class="fas fa-chalkboard-teacher"></i></div>
            <div class="stat-info">
                <h3>{{ number_format($stats['instructors']) }}</h3>
                <p>Instructors</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon green"><i class="fas fa-dollar-sign"></i></div>
            <div class="stat-info">
                <h3>${{ number_format($stats['revenue'], 0) }}</h3>
                <p>Total Revenue</p>
            </div>
        </div>
    </div>

    <div style="display: grid; grid-template-columns: 1.6fr 1fr; gap: 20px;">
        <!-- Recent Enrollments -->
        <div class="card">
            <div class="card-header">
                <div>
                    <div class="card-title">Recent Enrollments</div>
                </div>
                <a href="{{ route('admin.enrollments.index') }}" class="btn btn-secondary btn-sm">View All</a>
            </div>
            @if($recentEnrollments->count() > 0)
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Student</th>
                            <th>Course</th>
                            <th>Progress</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentEnrollments as $e)
                            <tr>
                                <td>
                                    <div style="display:flex; align-items:center; gap:10px;">
                                        <div class="avatar" style="width:30px; height:30px; font-size:11px;">{{ substr($e->student->name, 0, 1) }}</div>
                                        <span style="font-size:13px;">{{ $e->student->name }}</span>
                                    </div>
                                </td>
                                <td style="font-size:12px; color:var(--muted);">{{ Str::limit($e->course->title, 25) }}</td>
                                <td>
                                    <div style="display:flex; align-items:center; gap:8px;">
                                        <div class="progress-bar"><div class="progress-fill" style="width:{{ $e->progress }}%;"></div></div>
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
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="empty-state">
                    <i class="fas fa-clipboard-list"></i>
                    <h3>No Enrollments Yet</h3>
                    <p>Enroll students into courses to get started.</p>
                </div>
            @endif
        </div>

        <!-- Top Courses -->
        <div class="card">
            <div class="card-header">
                <div class="card-title">Top Courses</div>
                <a href="{{ route('admin.courses.index') }}" class="btn btn-secondary btn-sm">View All</a>
            </div>
            @if($topCourses->count() > 0)
                <div style="display:flex; flex-direction:column; gap:14px;">
                    @foreach($topCourses as $c)
                        <div style="display:flex; align-items:center; justify-content:space-between; gap:12px;">
                            <div style="flex:1; min-width:0;">
                                <div style="font-size:13px; font-weight:600; color:var(--text); margin-bottom:4px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">{{ $c->title }}</div>
                                <div style="font-size:11px; color:var(--muted);">{{ $c->category }} &bull; {{ $c->level }}</div>
                            </div>
                            <span class="badge badge-purple">{{ $c->enrollments_count }} students</span>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="empty-state" style="padding:30px 10px;">
                    <i class="fas fa-book"></i>
                    <p>No courses found.</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="card">
        <div class="card-title" style="margin-bottom:16px;">Quick Actions</div>
        <div style="display:flex; gap:12px; flex-wrap:wrap;">
            <a href="{{ route('admin.students.create') }}" class="btn btn-primary"><i class="fas fa-user-plus"></i> Add Student</a>
            <a href="{{ route('admin.courses.create') }}" class="btn btn-success"><i class="fas fa-plus-circle"></i> New Course</a>
            <a href="{{ route('admin.instructors.create') }}" class="btn btn-warning"><i class="fas fa-user-tie"></i> Add Instructor</a>
            <a href="{{ route('admin.enrollments.create') }}" class="btn btn-secondary"><i class="fas fa-clipboard-list"></i> Enroll Student</a>
        </div>
    </div>
@endsection
