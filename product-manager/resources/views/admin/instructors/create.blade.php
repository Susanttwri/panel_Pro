@extends('layouts.admin')
@section('title', 'Add Instructor')
@section('page-title', 'Add Instructor')
@section('breadcrumb', 'Admin / Instructors / Create')

@section('content')
    <div class="card" style="max-width: 700px;">
        <div class="card-header">
            <div class="card-title">New Instructor</div>
            <a href="{{ route('admin.instructors.index') }}" class="btn btn-secondary btn-sm"><i class="fas fa-arrow-left"></i> Back</a>
        </div>
        <form action="{{ route('admin.instructors.store') }}" method="POST">
            @csrf
            <div class="form-grid">
                <div class="form-group">
                    <label class="form-label">Full Name *</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required placeholder="Dr. Jane Smith">
                </div>
                <div class="form-group">
                    <label class="form-label">Email Address *</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" required placeholder="jane@example.com">
                </div>
                <div class="form-group">
                    <label class="form-label">Phone</label>
                    <input type="text" name="phone" class="form-control" value="{{ old('phone') }}" placeholder="+1-555-0000">
                </div>
                <div class="form-group">
                    <label class="form-label">Specialization</label>
                    <input type="text" name="specialization" class="form-control" value="{{ old('specialization') }}" placeholder="e.g. Machine Learning">
                </div>
                <div class="form-group">
                    <label class="form-label">Qualification</label>
                    <input type="text" name="qualification" class="form-control" value="{{ old('qualification') }}" placeholder="e.g. PhD Computer Science">
                </div>
                <div class="form-group">
                    <label class="form-label">Years of Experience</label>
                    <input type="number" name="experience_years" class="form-control" value="{{ old('experience_years', 0) }}" min="0">
                </div>
                <div class="form-group full">
                    <label class="form-label">Bio</label>
                    <textarea name="bio" class="form-control" rows="4" placeholder="Brief bio...">{{ old('bio') }}</textarea>
                </div>
                <div class="form-group full">
                    <div class="form-check">
                        <input type="checkbox" name="is_active" id="is_active" {{ old('is_active', true) ? 'checked' : '' }}>
                        <label for="is_active">Active (visible to students)</label>
                    </div>
                </div>
            </div>
            <div style="display:flex; gap:10px; margin-top:8px;">
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save Instructor</button>
                <a href="{{ route('admin.instructors.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
@endsection
