<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Course;
use App\Models\Instructor;
use App\Models\Enrollment;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'students'    => Student::count(),
            'courses'     => Course::count(),
            'instructors' => Instructor::count(),
            'enrollments' => Enrollment::count(),
            'active_students'  => Student::where('status', 'active')->count(),
            'active_courses'   => Course::where('is_active', true)->count(),
            'revenue'          => Enrollment::sum('amount_paid'),
            'completed'        => Enrollment::where('status', 'completed')->count(),
        ];

        $recentEnrollments = Enrollment::with(['student', 'course'])
            ->latest()
            ->take(8)
            ->get();

        $topCourses = Course::withCount('enrollments')
            ->orderByDesc('enrollments_count')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentEnrollments', 'topCourses'));
    }
}
