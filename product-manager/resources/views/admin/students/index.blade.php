@extends('layouts.admin')
@section('title', 'Students')
@section('page-title', 'Students')
@section('breadcrumb', 'Admin / Students')

@section('content')
    <div class="card">
        <div class="card-header">
            <div>
                <div class="card-title">All Students</div>
                <div style="font-size:12px; color:var(--muted); margin-top:2px;">{{ $students->total() }} total records</div>
            </div>
            <a href="{{ route('admin.students.create') }}" class="btn btn-primary"><i class="fas fa-user-plus"></i> Add Student</a>
        </div>

        <form method="GET" class="search-bar">
            <div class="search-input-wrap">
                <i class="fas fa-search"></i>
                <input type="text" name="search" value="{{ request('search') }}" class="form-control search-input" placeholder="Search students...">
            </div>
            <select name="status" class="form-control" style="max-width:160px;">
                <option value="">All Status</option>
                <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                <option value="suspended" {{ request('status') == 'suspended' ? 'selected' : '' }}>Suspended</option>
            </select>
            <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-filter"></i> Filter</button>
            @if(request()->hasAny(['search', 'status']))
                <a href="{{ route('admin.students.index') }}" class="btn btn-secondary btn-sm">Clear</a>
            @endif
        </form>

        @if($students->count() > 0)
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Student</th>
                        <th>ID</th>
                        <th>Contact</th>
                        <th>Enrollments</th>
                        <th>Status</th>
                        <th>Joined</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($students as $student)
                        <tr>
                            <td>
                                <div style="display:flex; align-items:center; gap:10px;">
                                    <div class="avatar">{{ substr($student->name, 0, 1) }}</div>
                                    <div>
                                        <div style="font-weight:600; font-size:13.5px;">{{ $student->name }}</div>
                                        <div style="font-size:12px; color:var(--muted);">{{ $student->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td><span style="font-size:12px; color:var(--muted); font-family:monospace;">{{ $student->student_id }}</span></td>
                            <td style="font-size:12px; color:var(--muted);">{{ $student->phone ?? '—' }}</td>
                            <td>
                                <span class="badge badge-purple">{{ $student->enrollments_count }} courses</span>
                            </td>
                            <td>
                                @if($student->status === 'active')
                                    <span class="badge badge-success">Active</span>
                                @elseif($student->status === 'inactive')
                                    <span class="badge badge-warning">Inactive</span>
                                @else
                                    <span class="badge badge-danger">Suspended</span>
                                @endif
                            </td>
                            <td style="font-size:12px; color:var(--muted);">{{ $student->created_at->format('M d, Y') }}</td>
                            <td>
                                <div class="actions-cell">
                                    <a href="{{ route('admin.students.show', $student) }}" class="btn btn-sm btn-success" title="View"><i class="fas fa-eye"></i></a>
                                    <a href="{{ route('admin.students.edit', $student) }}" class="btn btn-sm btn-warning" title="Edit"><i class="fas fa-pen"></i></a>
                                    <form action="{{ route('admin.students.destroy', $student) }}" method="POST" onsubmit="return confirm('Delete this student?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Delete"><i class="fas fa-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="pagination-wrapper">{{ $students->links() }}</div>
        @else
            <div class="empty-state">
                <i class="fas fa-user-graduate"></i>
                <h3>No Students Found</h3>
                <p>Try adjusting your search or add a new student.</p>
                <a href="{{ route('admin.students.create') }}" class="btn btn-primary"><i class="fas fa-user-plus"></i> Add Student</a>
            </div>
        @endif
    </div>
@endsection
