@extends('layouts.admin')
@section('title', 'Edit Instructor')
@section('page-title', 'Edit Instructor')
@section('breadcrumb', 'Admin / Instructors / Edit')

@section('content')
    <div class="card" style="max-width: 700px;">
        <div class="card-header">
            <div class="card-title">Edit: {{ $instructor->name }}</div>
            <a href="{{ route('admin.instructors.index') }}" class="btn btn-secondary btn-sm"><i class="fas fa-arrow-left"></i> Back</a>
        </div>
        <form action="{{ route('admin.instructors.update', $instructor) }}" method="POST">
            @csrf @method('PUT')
            <div class="form-grid">
                <div class="form-group">
                    <label class="form-label">Full Name *</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $instructor->name) }}" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Email Address *</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $instructor->email) }}" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Phone</label>
                    <input type="text" name="phone" class="form-control" value="{{ old('phone', $instructor->phone) }}">
                </div>
                <div class="form-group">
                    <label class="form-label">Specialization</label>
                    <input type="text" name="specialization" class="form-control" value="{{ old('specialization', $instructor->specialization) }}">
                </div>
                <div class="form-group">
                    <label class="form-label">Qualification</label>
                    <input type="text" name="qualification" class="form-control" value="{{ old('qualification', $instructor->qualification) }}">
                </div>
                <div class="form-group">
                    <label class="form-label">Years of Experience</label>
                    <input type="number" name="experience_years" class="form-control" value="{{ old('experience_years', $instructor->experience_years) }}" min="0">
                </div>
                <div class="form-group full">
                    <label class="form-label">Bio</label>
                    <textarea name="bio" class="form-control" rows="4">{{ old('bio', $instructor->bio) }}</textarea>
                </div>
                <div class="form-group full">
                    <div class="form-check">
                        <input type="checkbox" name="is_active" id="is_active" {{ old('is_active', $instructor->is_active) ? 'checked' : '' }}>
                        <label for="is_active">Active</label>
                    </div>
                </div>
            </div>
            <div style="display:flex; gap:10px; margin-top:8px;">
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Update</button>
                <a href="{{ route('admin.instructors.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
@endsection
