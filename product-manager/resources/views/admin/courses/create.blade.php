@extends('layouts.admin')
@section('title', 'New Course')
@section('page-title', 'New Course')
@section('breadcrumb', 'Admin / Courses / Create')

@section('content')
    <div class="card" style="max-width: 760px;">
        <div class="card-header">
            <div class="card-title">Create Course</div>
            <a href="{{ route('admin.courses.index') }}" class="btn btn-secondary btn-sm"><i class="fas fa-arrow-left"></i> Back</a>
        </div>
        <form action="{{ route('admin.courses.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-grid">
                <div class="form-group full">
                    <label class="form-label">Course Title *</label>
                    <input type="text" name="title" class="form-control" value="{{ old('title') }}" required placeholder="e.g. Advanced Python Programming">
                </div>
                <div class="form-group full">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="4" placeholder="Course description...">{{ old('description') }}</textarea>
                </div>
                <div class="form-group">
                    <label class="form-label">Category *</label>
                    <input type="text" name="category" class="form-control" value="{{ old('category') }}" required placeholder="e.g. Technology, Mathematics">
                </div>
                <div class="form-group">
                    <label class="form-label">Level *</label>
                    <select name="level" class="form-control" required>
                        <option value="Beginner" {{ old('level') == 'Beginner' ? 'selected' : '' }}>Beginner</option>
                        <option value="Intermediate" {{ old('level') == 'Intermediate' ? 'selected' : '' }}>Intermediate</option>
                        <option value="Advanced" {{ old('level') == 'Advanced' ? 'selected' : '' }}>Advanced</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Price (Rs.) *</label>
                    <input type="number" name="price" class="form-control" value="{{ old('price', 0) }}" required min="0" step="0.01">
                </div>
                <div class="form-group">
                    <label class="form-label">Duration (hours) *</label>
                    <input type="number" name="duration_hours" class="form-control" value="{{ old('duration_hours', 0) }}" required min="0">
                </div>
                <div class="form-group">
                    <label class="form-label">Instructor</label>
                    <select name="instructor_id" class="form-control">
                        <option value="">No instructor</option>
                        @foreach($instructors as $instructor)
                            <option value="{{ $instructor->id }}" {{ old('instructor_id') == $instructor->id ? 'selected' : '' }}>{{ $instructor->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Start Date *</label>
                    <input type="date" name="start_date" class="form-control" value="{{ old('start_date') }}" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Enrollment Deadline *</label>
                    <input type="date" name="deadline" class="form-control" value="{{ old('deadline') }}" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Max Students *</label>
                    <input type="number" name="max_students" class="form-control" value="{{ old('max_students', 100) }}" required min="1">
                </div>
                <div class="form-group">
                    <label class="form-label">Thumbnail</label>
                    <input type="file" name="thumbnail" class="form-control" accept="image/*">
                </div>
                <div class="form-group full" style="display:flex; gap:20px;">
                    <div class="form-check">
                        <input type="checkbox" name="is_active" id="is_active" {{ old('is_active', true) ? 'checked' : '' }}>
                        <label for="is_active">Active (visible to students)</label>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" name="is_featured" id="is_featured" {{ old('is_featured') ? 'checked' : '' }}>
                        <label for="is_featured">Featured on homepage</label>
                    </div>
                </div>
            </div>
            <div style="display:flex; gap:10px; margin-top:8px;">
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Create Course</button>
                <a href="{{ route('admin.courses.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
@endsection
