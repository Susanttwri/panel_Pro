@extends('layouts.admin')
@section('title', 'Edit Enrollment')
@section('page-title', 'Edit Enrollment')
@section('breadcrumb', 'Admin / Enrollments / Edit')

@section('content')
    <div class="card" style="max-width: 700px;">
        <div class="card-header">
            <div class="card-title">Edit Enrollment</div>
            <a href="{{ route('admin.enrollments.index') }}" class="btn btn-secondary btn-sm"><i class="fas fa-arrow-left"></i> Back</a>
        </div>
        <div style="padding:12px; background:rgba(99,102,241,.08); border:1px solid rgba(99,102,241,.2); border-radius:8px; margin-bottom:20px; font-size:13px;">
            <strong style="color:var(--accent-light);">{{ $enrollment->student->name }}</strong>
            <span style="color:var(--muted);"> enrolled in </span>
            <strong style="color:var(--accent-light);">{{ $enrollment->course->title }}</strong>
        </div>
        <form action="{{ route('admin.enrollments.update', $enrollment) }}" method="POST">
            @csrf @method('PUT')
            <div class="form-grid">
                <div class="form-group">
                    <label class="form-label">Enrollment Date *</label>
                    <input type="date" name="enrolled_at" class="form-control" value="{{ old('enrolled_at', $enrollment->enrolled_at->format('Y-m-d')) }}" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Status *</label>
                    <select name="status" class="form-control" required>
                        <option value="active" {{ old('status', $enrollment->status) == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="completed" {{ old('status', $enrollment->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="dropped" {{ old('status', $enrollment->status) == 'dropped' ? 'selected' : '' }}>Dropped</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Progress (%) *</label>
                    <input type="number" name="progress" class="form-control" value="{{ old('progress', $enrollment->progress) }}" min="0" max="100" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Amount Paid ($) *</label>
                    <input type="number" name="amount_paid" class="form-control" value="{{ old('amount_paid', $enrollment->amount_paid) }}" min="0" step="0.01" required>
                </div>
                <div class="form-group full">
                    <label class="form-label">Notes</label>
                    <textarea name="notes" class="form-control">{{ old('notes', $enrollment->notes) }}</textarea>
                </div>
            </div>
            <div style="display:flex; gap:10px; margin-top:8px;">
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Update Enrollment</button>
                <a href="{{ route('admin.enrollments.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
@endsection
