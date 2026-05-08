<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use App\Models\Student;
use App\Models\Course;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    public function index(Request $request)
    {
        $query = Enrollment::with(['student', 'course']);

        if ($request->search) {
            $query->whereHas('student', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%');
            })->orWhereHas('course', function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->status) {
            $query->where('status', $request->status);
        }

        $enrollments = $query->latest()->paginate(12)->withQueryString();
        return view('admin.enrollments.index', compact('enrollments'));
    }

    public function create()
    {
        $students = Student::where('status', 'active')->orderBy('name')->get();
        $courses  = Course::where('is_active', true)->orderBy('title')->get();
        return view('admin.enrollments.create', compact('students', 'courses'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id'  => 'required|exists:students,id',
            'course_id'   => 'required|exists:courses,id',
            'enrolled_at' => 'required|date',
            'status'      => 'required|in:active,completed,dropped',
            'progress'    => 'required|integer|min:0|max:100',
            'amount_paid' => 'required|numeric|min:0',
            'notes'       => 'nullable|string',
        ]);

        // Check for duplicate enrollment
        $exists = Enrollment::where('student_id', $validated['student_id'])
            ->where('course_id', $validated['course_id'])
            ->exists();

        if ($exists) {
            return back()->withErrors(['student_id' => 'This student is already enrolled in this course.'])->withInput();
        }

        Enrollment::create($validated);

        return redirect()->route('admin.enrollments.index')
            ->with('success', 'Student enrolled successfully!');
    }

    public function edit(Enrollment $enrollment)
    {
        $students = Student::where('status', 'active')->orderBy('name')->get();
        $courses  = Course::where('is_active', true)->orderBy('title')->get();
        return view('admin.enrollments.edit', compact('enrollment', 'students', 'courses'));
    }

    public function update(Request $request, Enrollment $enrollment)
    {
        $validated = $request->validate([
            'enrolled_at' => 'required|date',
            'status'      => 'required|in:active,completed,dropped',
            'progress'    => 'required|integer|min:0|max:100',
            'amount_paid' => 'required|numeric|min:0',
            'notes'       => 'nullable|string',
        ]);

        $enrollment->update($validated);

        return redirect()->route('admin.enrollments.index')
            ->with('success', 'Enrollment updated successfully!');
    }

    public function destroy(Enrollment $enrollment)
    {
        $enrollment->delete();
        return redirect()->route('admin.enrollments.index')
            ->with('success', 'Enrollment removed successfully!');
    }
}
