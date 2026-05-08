@extends('layouts.admin')
@section('title', 'Add Student')
@section('page-title', 'Add Student')
@section('breadcrumb', 'Admin / Students / Add')

@section('content')
    <div class="card" style="max-width: 700px;">
        <div class="card-header">
            <div class="card-title">New Student</div>
            <a href="{{ route('admin.students.index') }}" class="btn btn-secondary btn-sm"><i class="fas fa-arrow-left"></i> Back</a>
        </div>
        <form action="{{ route('admin.students.store') }}" method="POST">
            @csrf
            <div class="form-grid">
                <div class="form-group">
                    <label class="form-label">Full Name *</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required placeholder="e.g. John Doe">
                </div>
                <div class="form-group">
                    <label class="form-label">Email Address *</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" required placeholder="john@example.com">
                </div>
                <div class="form-group">
                    <label class="form-label">Phone</label>
                    <input type="text" name="phone" class="form-control" value="{{ old('phone') }}" placeholder="+1-555-0000">
                </div>
                <div class="form-group">
                    <label class="form-label">Date of Birth</label>
                    <input type="date" name="date_of_birth" class="form-control" value="{{ old('date_of_birth') }}">
                </div>
                <div class="form-group">
                    <label class="form-label">Gender</label>
                    <select name="gender" class="form-control">
                        <option value="">Select gender</option>
                        <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                        <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Status *</label>
                    <select name="status" class="form-control" required>
                        <option value="active" {{ old('status','active') == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        <option value="suspended" {{ old('status') == 'suspended' ? 'selected' : '' }}>Suspended</option>
                    </select>
                </div>
                <div class="form-group full">
                    <label class="form-label">Address</label>
                    <textarea name="address" class="form-control" placeholder="Full address...">{{ old('address') }}</textarea>
                </div>
            </div>
            <div style="display:flex; gap:10px; margin-top:8px;">
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save Student</button>
                <a href="{{ route('admin.students.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
@endsection
