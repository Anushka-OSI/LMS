<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseUser;
use App\Models\OnlineClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function index()
    {
        return view('student.index');
    }


    // Show the list of available courses
    public function viewCourses()
    {
        $courses = Course::all(); // Fetch all available courses
        return view('student.courses', compact('courses'));
    }

    // Show the courses the student is enrolled in
    public function viewEnrolledCourses()
    {
        // Assuming there is a relationship between user and courses, like:
        // public function courses() { return $this->belongsToMany(Course::class); }
        $courses = auth()->user()->courses()->wherePivot('approved', true)->get(); // Get courses the student is enrolled in
        return view('student.enrolled_courses', compact('courses'));
    }

    // Show the student's profile
    public function viewProfile()
    {
        // Fetch student profile data from the database
        return view('student.profile');
    }

    public function enrollCourse($courseId)
    {
        // Check if the course exists
        $course = Course::findOrFail($courseId);

        // Enroll student, but set 'approved' to false initially
        auth()->user()->courses()->attach($course, ['approved' => false]);

        // Redirect back to enrolled courses page with success message
        return redirect()->route('student.enrolledCourses')->with('success', 'You have successfully enrolled in the course!');
    }

    // Show the settings page for the student
    public function settings()
    {
        return view('student.settings');
    }

    public function showOnlineClasses()
    {
        $coursesid = CourseUser::where('user_id', Auth::user()->id)->where('approved', true)->pluck('course_id');

        if ($coursesid->isEmpty()) {
            return redirect()->route('student.dashboard')->with('error', 'You are not enrolled in any approved courses.');
        }

        $onlineClasses = OnlineClass::whereIn('course_id', $coursesid)->get();

        $onlineClassesID = OnlineClass::whereIn('course_id', $coursesid)->pluck('course_id');

        $courses = Course::whereIn('id', $onlineClassesID)->get();

        return view('student.online-classes', compact('courses', 'onlineClasses'));
    }
}
