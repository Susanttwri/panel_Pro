<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Instructor;
use App\Models\Student;
use App\Models\Enrollment;

class FrontendController extends Controller
{
    public function home()
    {
        $featuredCourses = Course::with('instructor')
            ->where('is_active', true)
            ->where('is_featured', true)
            ->take(6)
            ->get();

        if ($featuredCourses->isEmpty()) {
            $featuredCourses = Course::with('instructor')
                ->where('is_active', true)
                ->latest()
                ->take(6)
                ->get();
        }

        $stats = [
            'students'    => Student::count(),
            'courses'     => Course::where('is_active', true)->count(),
            'instructors' => Instructor::where('is_active', true)->count(),
            'enrollments' => Enrollment::count(),
        ];

        $instructors = Instructor::withCount('courses')
            ->where('is_active', true)
            ->take(4)
            ->get();

        return view('frontend.home', compact('featuredCourses', 'stats', 'instructors'));
    }

    public function courses()
    {
        $query = Course::with('instructor')
            ->withCount('enrollments')
            ->where('is_active', true);

        if (request('category')) {
            $query->where('category', request('category'));
        }

        if (request('level')) {
            $query->where('level', request('level'));
        }

        if (request('search')) {
            $query->where('title', 'like', '%' . request('search') . '%');
        }

        $courses    = $query->latest()->paginate(12)->withQueryString();
        $categories = Course::where('is_active', true)->distinct()->pluck('category');

        return view('frontend.courses', compact('courses', 'categories'));
    }

    public function courseDetail(Course $course)
    {
        if (!$course->is_active) {
            abort(404);
        }

        $course->load(['instructor', 'enrollments']);

        $related = Course::with('instructor')
            ->where('is_active', true)
            ->where('id', '!=', $course->id)
            ->where('category', $course->category)
            ->take(3)
            ->get();

        return view('frontend.course-detail', compact('course', 'related'));
    }

    public function instructors()
    {
        $instructors = Instructor::withCount('courses')
            ->where('is_active', true)
            ->get();

        return view('frontend.instructors', compact('instructors'));
    }
}
