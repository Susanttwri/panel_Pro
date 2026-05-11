<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Instructor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $query = Course::with('instructor')->withCount('enrollments');

        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('category', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->category) {
            $query->where('category', $request->category);
        }

        if ($request->level) {
            $query->where('level', $request->level);
        }

        $courses = $query->latest()->paginate(12)->withQueryString();
        $categories = Course::distinct()->pluck('category');

        return view('admin.courses.index', compact('courses', 'categories'));
    }

    public function create()
    {
        $instructors = Instructor::where('is_active', true)->get();
        return view('admin.courses.create', compact('instructors'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'          => 'required|string|max:255',
            'description'    => 'nullable|string',
            'category'       => 'required|string|max:100',
            'level'          => 'required|in:Beginner,Intermediate,Advanced',
            'price'          => 'required|numeric|min:0',
            'duration_hours' => 'required|integer|min:0',
            'start_date'     => 'required|date',
            'deadline'       => 'required|date|after_or_equal:today',
            'max_students'   => 'required|integer|min:1',
            'thumbnail'      => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'instructor_id'  => 'nullable|exists:instructors,id',
            'is_active'      => 'boolean',
            'is_featured'    => 'boolean',
        ]);

        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request->file('thumbnail')->store('courses', 'public');
        }

        $validated['is_active']   = $request->has('is_active');
        $validated['is_featured'] = $request->has('is_featured');
        $validated['slug']        = Str::slug($validated['title']) . '-' . Str::random(4);

        Course::create($validated);

        return redirect()->route('admin.courses.index')
            ->with('success', 'Course created successfully!');
    }

    public function show(Course $course)
    {
        $course->load(['instructor', 'enrollments.student']);
        return view('admin.courses.show', compact('course'));
    }

    public function edit(Course $course)
    {
        $instructors = Instructor::where('is_active', true)->get();
        return view('admin.courses.edit', compact('course', 'instructors'));
    }

    public function update(Request $request, Course $course)
    {
        $validated = $request->validate([
            'title'          => 'required|string|max:255',
            'description'    => 'nullable|string',
            'category'       => 'required|string|max:100',
            'level'          => 'required|in:Beginner,Intermediate,Advanced',
            'price'          => 'required|numeric|min:0',
            'duration_hours' => 'required|integer|min:0',
            'start_date'     => 'required|date',
            'deadline'       => 'required|date',
            'max_students'   => 'required|integer|min:1',
            'thumbnail'      => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'instructor_id'  => 'nullable|exists:instructors,id',
            'is_active'      => 'boolean',
            'is_featured'    => 'boolean',
        ]);

        if ($request->hasFile('thumbnail')) {
            if ($course->thumbnail) {
                Storage::disk('public')->delete($course->thumbnail);
            }
            $validated['thumbnail'] = $request->file('thumbnail')->store('courses', 'public');
        }

        $validated['is_active']   = $request->has('is_active');
        $validated['is_featured'] = $request->has('is_featured');

        $course->update($validated);

        return redirect()->route('admin.courses.index')
            ->with('success', 'Course updated successfully!');
    }

    public function destroy(Course $course)
    {
        if ($course->thumbnail) {
            Storage::disk('public')->delete($course->thumbnail);
        }
        $course->delete();

        return redirect()->route('admin.courses.index')
            ->with('success', 'Course deleted successfully!');
    }
}
