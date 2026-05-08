<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Instructor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InstructorController extends Controller
{
    public function index(Request $request)
    {
        $query = Instructor::withCount('courses');

        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%')
                  ->orWhere('specialization', 'like', '%' . $request->search . '%');
            });
        }

        $instructors = $query->latest()->paginate(12)->withQueryString();
        return view('admin.instructors.index', compact('instructors'));
    }

    public function create()
    {
        return view('admin.instructors.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'             => 'required|string|max:255',
            'email'            => 'required|email|unique:instructors',
            'phone'            => 'nullable|string|max:20',
            'specialization'   => 'nullable|string|max:255',
            'bio'              => 'nullable|string',
            'qualification'    => 'nullable|string|max:255',
            'experience_years' => 'nullable|integer|min:0',
            'is_active'        => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        Instructor::create($validated);

        return redirect()->route('admin.instructors.index')
            ->with('success', 'Instructor added successfully!');
    }

    public function show(Instructor $instructor)
    {
        $instructor->load('courses');
        return view('admin.instructors.show', compact('instructor'));
    }

    public function edit(Instructor $instructor)
    {
        return view('admin.instructors.edit', compact('instructor'));
    }

    public function update(Request $request, Instructor $instructor)
    {
        $validated = $request->validate([
            'name'             => 'required|string|max:255',
            'email'            => 'required|email|unique:instructors,email,' . $instructor->id,
            'phone'            => 'nullable|string|max:20',
            'specialization'   => 'nullable|string|max:255',
            'bio'              => 'nullable|string',
            'qualification'    => 'nullable|string|max:255',
            'experience_years' => 'nullable|integer|min:0',
            'is_active'        => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $instructor->update($validated);

        return redirect()->route('admin.instructors.index')
            ->with('success', 'Instructor updated successfully!');
    }

    public function destroy(Instructor $instructor)
    {
        $instructor->delete();
        return redirect()->route('admin.instructors.index')
            ->with('success', 'Instructor deleted successfully!');
    }
}
