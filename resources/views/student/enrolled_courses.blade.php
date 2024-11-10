<!-- resources/views/student/enrolled_courses.blade.php -->

@extends('layouts.student')

@section('content')

    <h1>Enrolled Courses</h1>

    @if($courses->isEmpty())
        <p>You are not enrolled in any courses yet.</p>
    @else
        <ul class="list-group">
            @foreach($courses as $course)
                <li class="list-group-item my-2" style="background-color: rgb(249, 249, 180)">
                    <h4>{{ $course->title }}</h4>
                    <p>{{ $course->description }}</p>
                    <p><strong>Duration:</strong> {{ $course->duration }}</p>
                    <p><strong>Price:</strong> {{ number_format($course->price, 2) }}</p>
                </li>
            @endforeach
        </ul>
    @endif

@endsection
