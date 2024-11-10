<!-- resources/views/instructor/students.blade.php -->

@extends('layouts.instructor')

@section('content')
    <div class="container">
        <h2>Enrolled Students</h2>

        @if($students->isEmpty())
            <p>No students are enrolled in your courses.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Enrolled Courses</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($students as $student)
                        <tr>
                            <td>{{ $student->name }}</td>
                            <td>{{ $student->email }}</td>
                            <td>
                                @foreach($student->courses as $course)
                                    <span class="badge bg-info">{{ $course->title }}</span>
                                @endforeach
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
