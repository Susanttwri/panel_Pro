@extends('layouts.admin')
@section('title', 'New Enrollment')
@section('page-title', 'New Enrollment')
@section('breadcrumb', 'Admin / Enrollments / Create')

@section('content')
    <div class="card" style="max-width: 700px;">
        <div class="card-header">
            <div class="card-title">Enroll Student</div>
            <a href="{{ route('admin.enrollments.index') }}" class="btn btn-secondary btn-sm"><i class="fas fa-arrow-left"></i> Back</a>
        </div>
        <form action="{{ route('admin.enrollments.store') }}" method="POST">
            @csrf
            <div class="form-grid">
                <div class="form-group">
                    <label class="form-label">Student *</label>
                    <select name="student_id" class="form-control" required>
                        <option value="">Select student...</option>
                        @foreach($students as $student)
                            <option value="{{ $student->id }}" {{ (old('student_id') ?? request('student_id')) == $student->id ? 'selected' : '' }}>
                                {{ $student->name }} ({{ $student->student_id }})
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Course *</label>
                    <select name="course_id" class="form-control" required>
                        <option value="">Select course...</option>
                        @foreach($courses as $course)
                            <option value="{{ $course->id }}" {{ old('course_id') == $course->id ? 'selected' : '' }}>
                                {{ $course->title }} (Rs. {{ number_format($course->price, 0) }})
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Enrollment Date *</label>
                    <input type="date" name="enrolled_at" class="form-control" value="{{ old('enrolled_at', date('Y-m-d')) }}" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Status *</label>
                    <select name="status" class="form-control" required>
                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="dropped" {{ old('status') == 'dropped' ? 'selected' : '' }}>Dropped</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Progress (%) *</label>
                    <input type="number" name="progress" class="form-control" value="{{ old('progress', 0) }}" min="0" max="100" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Amount Paid (Rs.) *</label>
                    <input type="number" name="amount_paid" class="form-control" value="{{ old('amount_paid', 0) }}" min="0" step="0.01" required>
                </div>
                <div class="form-group full">
                    <label class="form-label">Notes</label>
                    <textarea name="notes" class="form-control" placeholder="Any additional notes...">{{ old('notes') }}</textarea>
                </div>
            </div>
            <div style="display:flex; gap:10px; margin-top:8px;">
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Enroll Student</button>
                <a href="{{ route('admin.enrollments.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
@endsection
