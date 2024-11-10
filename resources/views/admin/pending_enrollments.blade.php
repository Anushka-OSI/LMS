<!-- resources/views/admin/pending_enrollments.blade.php -->

@extends('layouts.admin')

@section('content')

    <h1>Pending Enrollments</h1>

    @if($pendingEnrollments->isEmpty())
        <p>No pending enrollments.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Course Title</th>
                    <th>Student Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pendingEnrollments as $enrollment)
                    <tr>
                        <td>{{ $enrollment->course_title }}</td>
                        <td>{{ $enrollment->student_name }}</td>
                        <td>
                            <a href="{{ route('admin.approveEnrollment', [$enrollment->course_id, $enrollment->user_id]) }}" class="btn btn-success">Approve</a>
                            <a href="{{ route('admin.rejectEnrollment', [$enrollment->course_id, $enrollment->user_id]) }}" class="btn btn-danger">Reject</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

@endsection
