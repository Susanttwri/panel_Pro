<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Services\CartService;

class CourseController extends Controller
{
    public function index(CartService $cart)
    {
        $query = Course::with('instructor')
            ->withCount('enrollments')
            ->where('is_active', true);

        if (request('search')) {
            $query->where(function ($q) {
                $q->where('title', 'like', '%' . request('search') . '%')
                    ->orWhere('description', 'like', '%' . request('search') . '%');
            });
        }

        if (request('category')) {
            $query->where('category', request('category'));
        }

        if (request('level')) {
            $query->where('level', request('level'));
        }

        $courses = $query->latest()->paginate(12)->withQueryString();
        $categories = Course::where('is_active', true)->distinct()->pluck('category');

        return view('student.courses', [
            'courses'    => $courses,
            'categories' => $categories,
            'cartCount'  => $cart->count(),
        ]);
    }
}
