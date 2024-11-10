<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Add this route
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');



Route::get('/signup', [AuthController::class, 'showSignupForm'])->name('signup');
Route::post('/signup', [AuthController::class, 'signup']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
Route::get('/student/dashboard', [StudentController::class, 'index'])->name('student.dashboard');
Route::get('/instructor/dashboard', [InstructorController::class, 'index'])->name('instructor.dashboard');


Route::get('/user/manage', [UserController::class, 'index'])->name('user.index');
Route::get('/user/manage/{user}/edit', [UserController::class, 'edit'])->name('user.edit');
Route::put('/user/manage/{user}', [UserController::class, 'update'])->name('user.update');


Route::get('/admin/courses', [CourseController::class, 'index'])->name('course.index');
Route::get('/admin/courses/create', [CourseController::class, 'create'])->name('course.create');
Route::post('/admin/courses', [CourseController::class, 'store'])->name('course.store');
Route::get('/admin/courses/{course}/edit', [CourseController::class, 'edit'])->name('course.edit');
Route::put('/admin/courses/{course}', [CourseController::class, 'update'])->name('course.update');

Route::get('/pending-enrollments', [AdminController::class, 'viewPendingEnrollments'])->name('admin.pendingEnrollments');
Route::get('/approve-enrollment/{courseId}/{userId}', [AdminController::class, 'approveEnrollment'])->name('admin.approveEnrollment');
Route::get('/reject-enrollment/{courseId}/{userId}', [AdminController::class, 'rejectEnrollment'])->name('admin.rejectEnrollment');


Route::get('/instructor/courses', [InstructorController::class, 'myCourses'])->name('myCourses');
Route::prefix('instructor')->name('instructor.')->group(function () {
    // Display courses and assignments
    Route::get('/my-courses', [InstructorController::class, 'myCourses'])->name('myCourses');

    // Upload assignment page
    Route::get('/course/{courseId}/upload-assignment', [InstructorController::class, 'showUploadAssignmentForm'])->name('uploadAssignment');

    // Store uploaded assignment
    Route::post('/course/{courseId}/upload-assignment', [InstructorController::class, 'storeAssignment'])->name('storeAssignment');
    Route::get('/assignments', [InstructorController::class, 'showAssignments'])->name('assignments');

    Route::get('/students', [InstructorController::class, 'showEnrolledStudents'])->name('students');
});





// Route::get('/student/dashboard', [StudentController::class, 'index'])->name('student.dashboard');
Route::get('/student/courses', [StudentController::class, 'viewCourses'])->name('student.courses');
Route::get('/student/enrolled-courses', [StudentController::class, 'viewEnrolledCourses'])->name('student.enrolledCourses');
Route::get('/student/profile', [StudentController::class, 'viewProfile'])->name('student.profile');
Route::get('/student/settings', [StudentController::class, 'settings'])->name('student.settings');
Route::post('/enroll/{course}', [StudentController::class, 'enrollCourse'])->name('student.enroll');




Route::get('/instructor/courses/online-classes', [InstructorController::class, 'manageOnlineClasses'])->name('instructor.manageOnlineClasses');
Route::post('/instructor/courses/{course}/online-classes', [InstructorController::class, 'storeOnlineClass'])->name('instructor.storeOnlineClass');
Route::post('/instructor/online-class/{onlineClass}/update-status', [InstructorController::class, 'updateOnlineClassStatus'])->name('instructor.updateOnlineClassStatus');
Route::get('/instructor/online-class/delete/{onlineClass}', [InstructorController::class, 'deleteOnlineClass'])->name('instructor.deleteOnlineClass');




Route::get('/student/online-classes', [StudentController::class, 'showOnlineClasses'])->name('student.onlineClasses');
