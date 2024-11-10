<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        return view('admin.index');
    }
    public function viewPendingEnrollments()
    {
        // Get the courses with 'approved' = false
        $pendingEnrollments = \DB::table('course_user')
            ->join('courses', 'course_user.course_id', '=', 'courses.id')
            ->join('users', 'course_user.user_id', '=', 'users.id')
            ->where('course_user.approved', false)
            ->select('course_user.*', 'courses.title as course_title', 'users.name as student_name')
            ->get();

        return view('admin.pending_enrollments', compact('pendingEnrollments'));
    }

    public function approveEnrollment($courseId, $userId)
    {
        // Approve the enrollment by setting 'approved' to true
        \DB::table('course_user')
            ->where('course_id', $courseId)
            ->where('user_id', $userId)
            ->update(['approved' => true]);

        return redirect()->route('admin.pendingEnrollments')->with('success', 'Enrollment approved.');
    }

    // Reject the enrollment
    public function rejectEnrollment($courseId, $userId)
    {
        // Remove the enrollment
        \DB::table('course_user')
            ->where('course_id', $courseId)
            ->where('user_id', $userId)
            ->delete();

        return redirect()->route('admin.pendingEnrollments')->with('success', 'Enrollment rejected.');
    }
}
