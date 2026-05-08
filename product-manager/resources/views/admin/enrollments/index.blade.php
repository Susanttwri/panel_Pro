@extends('layouts.admin')
@section('title', 'Enrollments')
@section('page-title', 'Enrollments')
@section('breadcrumb', 'Admin / Enrollments')

@section('content')
    <div class="card">
        <div class="card-header">
            <div>
                <div class="card-title">All Enrollments</div>
                <div style="font-size:12px; color:var(--muted); margin-top:2px;">{{ $enrollments->total() }} total records</div>
            </div>
            <a href="{{ route('admin.enrollments.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> New Enrollment</a>
        </div>

        <form method="GET" class="search-bar">
            <div class="search-input-wrap">
                <i class="fas fa-search"></i>
                <input type="text" name="search" value="{{ request('search') }}" class="form-control search-input" placeholder="Search student or course...">
            </div>
            <select name="status" class="form-control" style="max-width:160px;">
                <option value="">All Status</option>
                <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                <option value="dropped" {{ request('status') == 'dropped' ? 'selected' : '' }}>Dropped</option>
            </select>
            <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-filter"></i> Filter</button>
            @if(request()->hasAny(['search','status']))
                <a href="{{ route('admin.enrollments.index') }}" class="btn btn-secondary btn-sm">Clear</a>
            @endif
        </form>

        @if($enrollments->count() > 0)
            <table class="data-table">
                <thead>
                    <tr><th>Student</th><th>Course</th><th>Enrolled</th><th>Progress</th><th>Amount Paid</th><th>Status</th><th>Actions</th></tr>
                </thead>
                <tbody>
                    @foreach($enrollments as $e)
                        <tr>
                            <td>
                                <div style="display:flex; align-items:center; gap:10px;">
                                    <div class="avatar" style="width:30px; height:30px; font-size:11px;">{{ substr($e->student->name, 0, 1) }}</div>
                                    <div>
                                        <div style="font-weight:600; font-size:13px;">{{ $e->student->name }}</div>
                                        <div style="font-size:11px; color:var(--muted);">{{ $e->student->student_id }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div style="font-size:13px; font-weight:600;">{{ Str::limit($e->course->title, 30) }}</div>
                                <div style="font-size:11px; color:var(--muted);">{{ $e->course->category }}</div>
                            </td>
                            <td style="font-size:12px; color:var(--muted);">{{ $e->enrolled_at->format('M d, Y') }}</td>
                            <td>
                                <div style="display:flex; align-items:center; gap:8px;">
                                    <div class="progress-bar"><div class="progress-fill" style="width:{{ $e->progress }}%;"></div></div>
                                    <span style="font-size:11px; color:var(--muted);">{{ $e->progress }}%</span>
                                </div>
                            </td>
                            <td style="font-weight:700; color:var(--green);">${{ number_format($e->amount_paid, 0) }}</td>
                            <td>
                                @if($e->status === 'completed')<span class="badge badge-success">Completed</span>
                                @elseif($e->status === 'active')<span class="badge badge-info">Active</span>
                                @else<span class="badge badge-danger">Dropped</span>@endif
                            </td>
                            <td>
                                <div class="actions-cell">
                                    <a href="{{ route('admin.enrollments.edit', $e) }}" class="btn btn-sm btn-warning" title="Edit"><i class="fas fa-pen"></i></a>
                                    <form action="{{ route('admin.enrollments.destroy', $e) }}" method="POST" onsubmit="return confirm('Remove this enrollment?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Delete"><i class="fas fa-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="pagination-wrapper">{{ $enrollments->links() }}</div>
        @else
            <div class="empty-state">
                <i class="fas fa-clipboard-list"></i>
                <h3>No Enrollments Found</h3>
                <p>Start enrolling students into courses.</p>
                <a href="{{ route('admin.enrollments.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Enroll Student</a>
            </div>
        @endif
    </div>
@endsection
