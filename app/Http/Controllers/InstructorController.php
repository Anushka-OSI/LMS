<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Course;
use App\Models\OnlineClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InstructorController extends Controller
{
    public function index()
    {
        return view('instructor.index');
    }

    public function myCourses()
    {
        // Get courses that belong to the logged-in instructor
        $courses = Course::where('instructor_id', auth()->user()->id)->get();

        // Return view with courses data
        return view('instructor.courses.index', compact('courses'));
    }


    public function uploadAssignment($courseId)
    {
        // Get the course by ID to verify ownership
        $course = Course::findOrFail($courseId);

        // Ensure the logged-in user is the instructor of this course
        if ($course->instructor_id != auth()->user()->id) {
            return redirect()->route('instructor.myCourses')->with('error', 'You are not authorized to upload assignments for this course.');
        }

        return view('instructor.courses.upload-assignment', compact('course'));
    }

    // Store the uploaded assignment
    public function storeAssignment(Request $request, $courseId)
    {
        // Validate the request
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'file' => 'required|file|mimes:pdf,doc,docx,ppt,pptx|max:10240', // Allowing only document files
        ]);

        // Store the file and get the path
        $filePath = $request->file('file')->store('assignments', 'public');  // Save in the public storage

        // Create the assignment record
        Assignment::create([
            'title' => $validated['title'],
            'description' => $validated['description'] ?? 'No description provided.',
            'file_path' => $filePath,
            'course_id' => $courseId,
        ]);

        return redirect()->route('instructor.myCourses')->with('success', 'Assignment uploaded successfully!');
    }


    public function showUploadAssignmentForm($courseId)
    {
        // Get the course details for the given course ID
        $course = Course::findOrFail($courseId);

        // Return the view with the course data
        return view('instructor.courses.upload-assignment', compact('course'));
    }
    public function showAssignments()
    {
        // Get the current logged-in instructor's ID
        $instructorId = Auth::id();

        // Fetch all courses where the instructor is assigned
        $courses = Course::where('instructor_id', $instructorId)->get();

        // Fetch all assignments for the instructor
        // Assuming assignments have a relationship with courses
        $assignments = Assignment::whereIn('course_id', $courses->pluck('id'))->get();

        // Pass assignments data to the view
        return view('instructor.assignments.view', compact('assignments'));
    }

    public function showEnrolledStudents()
    {
        // Fetch students enrolled in the instructor's courses
        // You may need to adjust the logic based on your relationship between users (students) and courses

        // For example, assuming the instructor has a many-to-many relationship with courses and students
        $courses = auth()->user()->courses;  // Assuming that the authenticated user is the instructor
        $students = collect();

        foreach ($courses as $course) {
            // Fetch students for each course
            $students = $students->merge($course->students);  // Assuming the relationship is set up in the Course model
        }

        return view('instructor.students', compact('students'));
    }
    public function manageOnlineClasses()
    {
        // Get the instructor's courses (assuming user is logged in)
        $courses = Course::where('instructor_id', auth()->id())->get();

        // Get the online classes for each course
        $onlineClasses = OnlineClass::whereIn('course_id', $courses->pluck('id'))->get();

        return view('instructor.manage-online-classes', compact('courses', 'onlineClasses'));
    }
    public function storeOnlineClass(Request $request, $courseId)
    {
        $request->validate([
            'link' => 'required|url',
            'description' => 'required',
        ]);

        // Create a new online class for the course
        OnlineClass::create([
            'link' => $request->link,
            'description' => $request->description,
            'status' => false, // default status is not finished
            'course_id' => $courseId,
        ]);

        return redirect()->route('instructor.manageOnlineClasses')->with('success', 'Online class added successfully.');
    }

    public function updateOnlineClassStatus(OnlineClass $onlineClass)
{
    // Toggle the status (for example, mark as finished)
    $onlineClass->status = !$onlineClass->status;
    $onlineClass->save();

    return redirect()->route('instructor.manageOnlineClasses')->with('success', 'Online class status updated.');
}
public function deleteOnlineClass(OnlineClass $onlineClass)
{
    // Directly delete the passed OnlineClass instance
    $onlineClass->delete();

    // Redirect back with a success message
    return redirect()->route('instructor.manageOnlineClasses')->with('success', 'Online class deleted successfully.');
}
}
