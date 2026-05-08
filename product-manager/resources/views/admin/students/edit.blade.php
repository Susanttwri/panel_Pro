@extends('layouts.admin')
@section('title', 'Edit Student')
@section('page-title', 'Edit Student')
@section('breadcrumb', 'Admin / Students / Edit')

@section('content')
    <div class="card" style="max-width: 700px;">
        <div class="card-header">
            <div class="card-title">Edit: {{ $student->name }}</div>
            <a href="{{ route('admin.students.index') }}" class="btn btn-secondary btn-sm"><i class="fas fa-arrow-left"></i> Back</a>
        </div>
        <form action="{{ route('admin.students.update', $student) }}" method="POST">
            @csrf @method('PUT')
            <div class="form-grid">
                <div class="form-group">
                    <label class="form-label">Full Name *</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $student->name) }}" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Email Address *</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $student->email) }}" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Phone</label>
                    <input type="text" name="phone" class="form-control" value="{{ old('phone', $student->phone) }}">
                </div>
                <div class="form-group">
                    <label class="form-label">Date of Birth</label>
                    <input type="date" name="date_of_birth" class="form-control" value="{{ old('date_of_birth', $student->date_of_birth?->format('Y-m-d')) }}">
                </div>
                <div class="form-group">
                    <label class="form-label">Gender</label>
                    <select name="gender" class="form-control">
                        <option value="">Select gender</option>
                        <option value="male" {{ old('gender', $student->gender) == 'male' ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ old('gender', $student->gender) == 'female' ? 'selected' : '' }}>Female</option>
                        <option value="other" {{ old('gender', $student->gender) == 'other' ? 'selected' : '' }}>Other</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Status *</label>
                    <select name="status" class="form-control" required>
                        <option value="active" {{ old('status', $student->status) == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ old('status', $student->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        <option value="suspended" {{ old('status', $student->status) == 'suspended' ? 'selected' : '' }}>Suspended</option>
                    </select>
                </div>
                <div class="form-group full">
                    <label class="form-label">Address</label>
                    <textarea name="address" class="form-control">{{ old('address', $student->address) }}</textarea>
                </div>
            </div>
            <div style="display:flex; gap:10px; margin-top:8px;">
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Update Student</button>
                <a href="{{ route('admin.students.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
@endsection
