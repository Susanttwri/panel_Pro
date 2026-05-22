<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnrollmentController extends Controller
{
    protected function findEnrollment(Enrollment $enrollment): Enrollment
    {
        $student = Auth::user()->studentProfile;

        if (!$student || $enrollment->student_id !== $student->id) {
            abort(403);
        }

        return $enrollment->load(['course.instructor', 'course.quizQuestions', 'latestQuizAttempt']);
    }

    public function show(Enrollment $enrollment)
    {
        $enrollment = $this->findEnrollment($enrollment);

        return view('student.enrollment.show', [
            'enrollment' => $enrollment,
        ]);
    }

    public function updateProgress(Request $request, Enrollment $enrollment)
    {
        $enrollment = $this->findEnrollment($enrollment);

        $validated = $request->validate([
            'progress' => 'required|integer|min:0|max:100',
        ]);

        $enrollment->update([
            'progress'         => $validated['progress'],
            'last_activity_at' => now(),
        ]);

        return back()->with('cart_success', 'Learning progress updated to ' . $validated['progress'] . '%.');
    }
}
