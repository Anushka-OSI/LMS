<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::all();
        return view('admin.courses.index', compact('courses'));
    }

    // Show the form to create a new course
    public function create()
    {
        $instructors = User::where('role', 'instructor')->get();
        return view('admin.courses.create', compact('instructors'));
    }

    // Store the new course
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'duration' => 'required|string',
            'price' => 'required|string',
            'instructor_id' => 'required|exists:users,id',
        ]);

        Course::create($request->all());

        return redirect()->route('course.index')->with('success', 'Course created successfully.');
    }

    // Show the form to edit an existing course
    public function edit(Course $course)
    {
        $instructors = User::where('role', 'instructor')->get();
        return view('admin.courses.edit', compact('course', 'instructors'));
    }

    // Update the course
    public function update(Request $request, Course $course)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'duration' => 'required|string',
            'price' => 'required|string',
            'instructor_id' => 'required|exists:users,id',
        ]);

        $course->update($request->all());

        return redirect()->route('course.index')->with('success', 'Course updated successfully.');
    }
}
