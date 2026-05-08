@extends('layouts.admin')
@section('title', 'Instructors')
@section('page-title', 'Instructors')
@section('breadcrumb', 'Admin / Instructors')

@section('content')
    <div class="card">
        <div class="card-header">
            <div>
                <div class="card-title">All Instructors</div>
                <div style="font-size:12px; color:var(--muted); margin-top:2px;">{{ $instructors->total() }} total records</div>
            </div>
            <a href="{{ route('admin.instructors.create') }}" class="btn btn-primary"><i class="fas fa-user-tie"></i> Add Instructor</a>
        </div>

        <form method="GET" class="search-bar">
            <div class="search-input-wrap">
                <i class="fas fa-search"></i>
                <input type="text" name="search" value="{{ request('search') }}" class="form-control search-input" placeholder="Search instructors...">
            </div>
            <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-filter"></i> Search</button>
            @if(request('search'))
                <a href="{{ route('admin.instructors.index') }}" class="btn btn-secondary btn-sm">Clear</a>
            @endif
        </form>

        @if($instructors->count() > 0)
            <table class="data-table">
                <thead>
                    <tr><th>Instructor</th><th>Specialization</th><th>Qualification</th><th>Experience</th><th>Courses</th><th>Status</th><th>Actions</th></tr>
                </thead>
                <tbody>
                    @foreach($instructors as $instructor)
                        <tr>
                            <td>
                                <div style="display:flex; align-items:center; gap:10px;">
                                    <div class="avatar">{{ substr($instructor->name, 0, 1) }}</div>
                                    <div>
                                        <div style="font-weight:600; font-size:13.5px;">{{ $instructor->name }}</div>
                                        <div style="font-size:12px; color:var(--muted);">{{ $instructor->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td style="font-size:13px; color:var(--muted);">{{ $instructor->specialization ?? '—' }}</td>
                            <td style="font-size:13px; color:var(--muted);">{{ $instructor->qualification ?? '—' }}</td>
                            <td><span class="badge badge-info">{{ $instructor->experience_years }}yr</span></td>
                            <td><span class="badge badge-purple">{{ $instructor->courses_count }}</span></td>
                            <td>
                                @if($instructor->is_active)
                                    <span class="badge badge-success">Active</span>
                                @else
                                    <span class="badge badge-danger">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <div class="actions-cell">
                                    <a href="{{ route('admin.instructors.show', $instructor) }}" class="btn btn-sm btn-success" title="View"><i class="fas fa-eye"></i></a>
                                    <a href="{{ route('admin.instructors.edit', $instructor) }}" class="btn btn-sm btn-warning" title="Edit"><i class="fas fa-pen"></i></a>
                                    <form action="{{ route('admin.instructors.destroy', $instructor) }}" method="POST" onsubmit="return confirm('Delete this instructor?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Delete"><i class="fas fa-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="pagination-wrapper">{{ $instructors->links() }}</div>
        @else
            <div class="empty-state">
                <i class="fas fa-chalkboard-teacher"></i>
                <h3>No Instructors Found</h3>
                <p>Add your first instructor to get started.</p>
                <a href="{{ route('admin.instructors.create') }}" class="btn btn-primary"><i class="fas fa-user-plus"></i> Add Instructor</a>
            </div>
        @endif
    </div>
@endsection
