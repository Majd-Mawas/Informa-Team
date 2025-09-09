<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Category;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::with('category')->latest()->paginate(10);
        return view('courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('courses.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'Name' => 'required|string|max:255',
            'By' => 'nullable|string|max:255',
            'difficulty' => 'nullable|string|max:255',
            'type' => 'nullable|string|max:255',
            'duration' => 'nullable|string|max:255',
            'num_video' => 'nullable|string|max:255',
            'released_at' => 'nullable|date',
            'categories_id' => 'nullable|exists:categories,id',
            'telegram_link' => 'nullable|string|max:255',
        ]);

        Course::create($validated);

        return redirect()->route('courses.index')
            ->with('success', 'Course created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        return view('courses.show', compact('course'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        $categories = Category::all();
        return view('courses.edit', compact('course', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        $validated = $request->validate([
            'Name' => 'required|string|max:255',
            'By' => 'nullable|string|max:255',
            'difficulty' => 'nullable|string|max:255',
            'type' => 'nullable|string|max:255',
            'duration' => 'nullable|string|max:255',
            'num_video' => 'nullable|string|max:255',
            'released_at' => 'nullable|date',
            'categories_id' => 'nullable|exists:categories,id',
            'telegram_link' => 'nullable|string|max:255',
        ]);

        $course->update($validated);

        return redirect()->route('courses.index')
            ->with('success', 'Course updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        $course->delete();

        return redirect()->route('courses.index')
            ->with('success', 'Course deleted successfully.');
    }
}