@extends('layouts.admin')
@section('title', 'Courses')
@section('page-title', 'Courses')
@section('breadcrumb', 'Admin / Courses')

@section('content')
    <div class="card">
        <div class="card-header">
            <div>
                <div class="card-title">All Courses</div>
                <div style="font-size:12px; color:var(--muted); margin-top:2px;">{{ $courses->total() }} total records</div>
            </div>
            <a href="{{ route('admin.courses.create') }}" class="btn btn-primary"><i class="fas fa-plus-circle"></i> New Course</a>
        </div>

        <form method="GET" class="search-bar">
            <div class="search-input-wrap">
                <i class="fas fa-search"></i>
                <input type="text" name="search" value="{{ request('search') }}" class="form-control search-input" placeholder="Search courses...">
            </div>
            <select name="category" class="form-control" style="max-width:180px;">
                <option value="">All Categories</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                @endforeach
            </select>
            <select name="level" class="form-control" style="max-width:160px;">
                <option value="">All Levels</option>
                <option value="Beginner" {{ request('level') == 'Beginner' ? 'selected' : '' }}>Beginner</option>
                <option value="Intermediate" {{ request('level') == 'Intermediate' ? 'selected' : '' }}>Intermediate</option>
                <option value="Advanced" {{ request('level') == 'Advanced' ? 'selected' : '' }}>Advanced</option>
            </select>
            <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-filter"></i> Filter</button>
            @if(request()->hasAny(['search','category','level']))
                <a href="{{ route('admin.courses.index') }}" class="btn btn-secondary btn-sm">Clear</a>
            @endif
        </form>

        @if($courses->count() > 0)
            <table class="data-table">
                <thead>
                    <tr><th>Course</th><th>Category</th><th>Level</th><th>Instructor</th><th>Price</th><th>Students</th><th>Status</th><th>Actions</th></tr>
                </thead>
                <tbody>
                    @foreach($courses as $course)
                        <tr>
                            <td>
                                <div>
                                    <div style="font-weight:600; font-size:13.5px;">{{ $course->title }}</div>
                                    <div style="font-size:11px; color:var(--muted);">{{ $course->duration_hours }}h duration</div>
                                </div>
                            </td>
                            <td><span class="badge badge-purple">{{ $course->category }}</span></td>
                            <td>
                                @if($course->level == 'Beginner') <span class="badge badge-success">Beginner</span>
                                @elseif($course->level == 'Intermediate') <span class="badge badge-warning">Intermediate</span>
                                @else <span class="badge badge-danger">Advanced</span>
                                @endif
                            </td>
                            <td style="font-size:13px;">{{ $course->instructor?->name ?? '—' }}</td>
                            <td><span style="font-weight:700; color:var(--green);">Rs. {{ number_format($course->price, 0) }}</span></td>
                            <td>
                                <div style="font-size:13px; font-weight:600;">{{ $course->enrollments_count }} / {{ $course->max_students }}</div>
                                <div class="progress-bar" style="width:100%; margin-top:4px; height:4px;">
                                    <div class="progress-fill" style="width:{{ min(100, ($course->enrollments_count / max(1, $course->max_students)) * 100) }}%; background: {{ $course->enrollments_count >= $course->max_students ? 'var(--red)' : 'var(--accent)' }};"></div>
                                </div>
                            </td>
                            <td>
                                @if($course->is_active)
                                    <span class="badge badge-success">Active</span>
                                @else
                                    <span class="badge badge-danger">Inactive</span>
                                @endif
                                @if($course->is_featured)
                                    <span class="badge badge-warning" style="margin-left:4px;">Featured</span>
                                @endif
                            </td>
                            <td>
                                <div class="actions-cell">
                                    <a href="{{ route('admin.courses.show', $course) }}" class="btn btn-sm btn-success" title="View"><i class="fas fa-eye"></i></a>
                                    <a href="{{ route('admin.courses.edit', $course) }}" class="btn btn-sm btn-warning" title="Edit"><i class="fas fa-pen"></i></a>
                                    <form action="{{ route('admin.courses.destroy', $course) }}" method="POST" onsubmit="return confirm('Delete this course?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Delete"><i class="fas fa-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="pagination-wrapper">{{ $courses->links() }}</div>
        @else
            <div class="empty-state">
                <i class="fas fa-book-open"></i>
                <h3>No Courses Found</h3>
                <p>Create your first course to get started.</p>
                <a href="{{ route('admin.courses.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> New Course</a>
            </div>
        @endif
    </div>
@endsection
