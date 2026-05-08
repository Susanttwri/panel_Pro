@extends('layouts.admin')
@section('title', $instructor->name)
@section('page-title', 'Instructor Profile')
@section('breadcrumb', 'Admin / Instructors / Profile')

@section('content')
    <div style="display:grid; grid-template-columns:1fr 2fr; gap:20px; align-items:start;">
        <div class="card" style="text-align:center;">
            <div class="avatar" style="width:70px; height:70px; font-size:28px; margin:0 auto 16px;">{{ substr($instructor->name, 0, 1) }}</div>
            <h2 style="font-size:17px; font-weight:700; margin-bottom:4px;">{{ $instructor->name }}</h2>
            <p style="font-size:13px; color:var(--muted); margin-bottom:12px;">{{ $instructor->specialization }}</p>
            @if($instructor->is_active)<span class="badge badge-success">Active</span>
            @else<span class="badge badge-danger">Inactive</span>@endif
            <div style="margin-top:16px; border-top:1px solid var(--border); padding-top:14px; text-align:left;">
                @foreach([['envelope', $instructor->email], ['phone', $instructor->phone], ['graduation-cap', $instructor->qualification], ['star', $instructor->experience_years ? $instructor->experience_years . ' years experience' : null]] as [$icon, $val])
                    @if($val)
                        <div style="display:flex; align-items:center; gap:10px; margin-bottom:10px; font-size:13px;">
                            <i class="fas fa-{{ $icon }}" style="color:var(--muted); width:16px;"></i>
                            <span style="color:var(--text);">{{ $val }}</span>
                        </div>
                    @endif
                @endforeach
                @if($instructor->bio)
                    <div style="font-size:12px; color:var(--muted); margin-top:10px; line-height:1.6;">{{ $instructor->bio }}</div>
                @endif
            </div>
            <div style="display:flex; gap:8px; margin-top:14px;">
                <a href="{{ route('admin.instructors.edit', $instructor) }}" class="btn btn-warning btn-sm" style="flex:1; justify-content:center;"><i class="fas fa-pen"></i> Edit</a>
                <a href="{{ route('admin.instructors.index') }}" class="btn btn-secondary btn-sm" style="flex:1; justify-content:center;"><i class="fas fa-arrow-left"></i> Back</a>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <div class="card-title">Assigned Courses ({{ $instructor->courses->count() }})</div>
                <a href="{{ route('admin.courses.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> New Course</a>
            </div>
            @if($instructor->courses->count() > 0)
                <table class="data-table">
                    <thead>
                        <tr><th>Title</th><th>Category</th><th>Level</th><th>Price</th><th>Status</th><th>Actions</th></tr>
                    </thead>
                    <tbody>
                        @foreach($instructor->courses as $c)
                            <tr>
                                <td style="font-weight:600; font-size:13.5px;">{{ $c->title }}</td>
                                <td><span class="badge badge-purple">{{ $c->category }}</span></td>
                                <td>
                                    @if($c->level == 'Beginner')<span class="badge badge-success">Beginner</span>
                                    @elseif($c->level == 'Intermediate')<span class="badge badge-warning">Intermediate</span>
                                    @else<span class="badge badge-danger">Advanced</span>@endif
                                </td>
                                <td style="font-weight:700; color:var(--green);">${{ number_format($c->price, 0) }}</td>
                                <td>
                                    @if($c->is_active)<span class="badge badge-success">Active</span>
                                    @else<span class="badge badge-danger">Inactive</span>@endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.courses.edit', $c) }}" class="btn btn-sm btn-warning"><i class="fas fa-pen"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="empty-state">
                    <i class="fas fa-book"></i>
                    <h3>No Courses Assigned</h3>
                    <p>Assign this instructor to a course.</p>
                </div>
            @endif
        </div>
    </div>
@endsection
