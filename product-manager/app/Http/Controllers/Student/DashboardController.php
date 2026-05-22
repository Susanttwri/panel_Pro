<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Enrollment;
use App\Services\CartService;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(CartService $cart)
    {
        $user = Auth::user();
        $student = $user->studentProfile;

        $enrollments = $student
            ? Enrollment::with(['course.instructor', 'latestQuizAttempt'])
                ->where('student_id', $student->id)
                ->latest('enrolled_at')
                ->take(5)
                ->get()
            : collect();

        $featuredCourses = Course::with('instructor')
            ->withCount('enrollments')
            ->where('is_active', true)
            ->latest()
            ->take(6)
            ->get();

        return view('student.dashboard', [
            'student'         => $student,
            'enrollments'     => $enrollments,
            'enrolledCount'   => $student ? $student->enrollments()->count() : 0,
            'featuredCourses' => $featuredCourses,
            'cartCount'       => $cart->count(),
            'cartTotal'       => $cart->total(),
        ]);
    }

    public function enrollments()
    {
        $student = Auth::user()->studentProfile;

        $enrollments = $student
            ? Enrollment::with(['course.instructor', 'latestQuizAttempt'])
                ->where('student_id', $student->id)
                ->latest('enrolled_at')
                ->paginate(12)
            : collect();

        return view('student.enrollments', compact('student', 'enrollments'));
    }
}
