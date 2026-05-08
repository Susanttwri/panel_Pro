@extends('layouts.admin')
@section('title', 'Edit Course')
@section('page-title', 'Edit Course')
@section('breadcrumb', 'Admin / Courses / Edit')

@section('content')
    <div class="card" style="max-width: 760px;">
        <div class="card-header">
            <div class="card-title">Edit: {{ $course->title }}</div>
            <a href="{{ route('admin.courses.index') }}" class="btn btn-secondary btn-sm"><i class="fas fa-arrow-left"></i> Back</a>
        </div>
        <form action="{{ route('admin.courses.update', $course) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="form-grid">
                <div class="form-group full">
                    <label class="form-label">Course Title *</label>
                    <input type="text" name="title" class="form-control" value="{{ old('title', $course->title) }}" required>
                </div>
                <div class="form-group full">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="4">{{ old('description', $course->description) }}</textarea>
                </div>
                <div class="form-group">
                    <label class="form-label">Category *</label>
                    <input type="text" name="category" class="form-control" value="{{ old('category', $course->category) }}" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Level *</label>
                    <select name="level" class="form-control" required>
                        <option value="Beginner" {{ old('level', $course->level) == 'Beginner' ? 'selected' : '' }}>Beginner</option>
                        <option value="Intermediate" {{ old('level', $course->level) == 'Intermediate' ? 'selected' : '' }}>Intermediate</option>
                        <option value="Advanced" {{ old('level', $course->level) == 'Advanced' ? 'selected' : '' }}>Advanced</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Price ($) *</label>
                    <input type="number" name="price" class="form-control" value="{{ old('price', $course->price) }}" required min="0" step="0.01">
                </div>
                <div class="form-group">
                    <label class="form-label">Duration (hours) *</label>
                    <input type="number" name="duration_hours" class="form-control" value="{{ old('duration_hours', $course->duration_hours) }}" required min="0">
                </div>
                <div class="form-group">
                    <label class="form-label">Instructor</label>
                    <select name="instructor_id" class="form-control">
                        <option value="">No instructor</option>
                        @foreach($instructors as $instructor)
                            <option value="{{ $instructor->id }}" {{ old('instructor_id', $course->instructor_id) == $instructor->id ? 'selected' : '' }}>{{ $instructor->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Thumbnail (leave blank to keep current)</label>
                    @if($course->thumbnail)
                        <img src="{{ asset('storage/'.$course->thumbnail) }}" alt="Thumbnail" style="width:80px; height:50px; object-fit:cover; border-radius:6px; margin-bottom:6px; border:1px solid var(--border);">
                    @endif
                    <input type="file" name="thumbnail" class="form-control" accept="image/*">
                </div>
                <div class="form-group full" style="display:flex; gap:20px;">
                    <div class="form-check">
                        <input type="checkbox" name="is_active" id="is_active" {{ old('is_active', $course->is_active) ? 'checked' : '' }}>
                        <label for="is_active">Active</label>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" name="is_featured" id="is_featured" {{ old('is_featured', $course->is_featured) ? 'checked' : '' }}>
                        <label for="is_featured">Featured</label>
                    </div>
                </div>
            </div>
            <div style="display:flex; gap:10px; margin-top:8px;">
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Update Course</button>
                <a href="{{ route('admin.courses.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
@endsection
