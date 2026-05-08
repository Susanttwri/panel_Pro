<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $query = Student::withCount('enrollments');

        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%')
                  ->orWhere('student_id', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->status) {
            $query->where('status', $request->status);
        }

        $students = $query->latest()->paginate(12)->withQueryString();
        return view('admin.students.index', compact('students'));
    }

    public function create()
    {
        return view('admin.students.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'          => 'required|string|max:255',
            'email'         => 'required|email|unique:students',
            'phone'         => 'nullable|string|max:20',
            'date_of_birth' => 'nullable|date',
            'gender'        => 'nullable|in:male,female,other',
            'address'       => 'nullable|string',
            'status'        => 'required|in:active,inactive,suspended',
        ]);

        // Auto-generate student ID
        $validated['student_id'] = 'STU-' . strtoupper(substr(md5(time() . rand()), 0, 8));

        Student::create($validated);

        return redirect()->route('admin.students.index')
            ->with('success', 'Student added successfully!');
    }

    public function show(Student $student)
    {
        $student->load(['enrollments.course.instructor']);
        return view('admin.students.show', compact('student'));
    }

    public function edit(Student $student)
    {
        return view('admin.students.edit', compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'name'          => 'required|string|max:255',
            'email'         => 'required|email|unique:students,email,' . $student->id,
            'phone'         => 'nullable|string|max:20',
            'date_of_birth' => 'nullable|date',
            'gender'        => 'nullable|in:male,female,other',
            'address'       => 'nullable|string',
            'status'        => 'required|in:active,inactive,suspended',
        ]);

        $student->update($validated);

        return redirect()->route('admin.students.index')
            ->with('success', 'Student updated successfully!');
    }

    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('admin.students.index')
            ->with('success', 'Student deleted successfully!');
    }
}
