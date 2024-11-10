<!-- resources/views/student/courses.blade.php -->

@extends('layouts.student')

@section('content')
    <h1>Available Courses</h1>
    <ul class="list-group">
        @foreach ($courses as $course)
            <li class="list-group-item my-2" style="background-color: rgb(249, 249, 180)">
                <h4>{{ $course->title }}</h4>
                <p>{{ $course->description }}</p>
                <p><strong>Duration:</strong> {{ $course->duration }}</p>
                <p><strong>Price:</strong> {{ number_format($course->price, 2) }}</p>
                <form action="{{ route('student.enroll', $course->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary">Enroll</button>
                </form>
            </li>
        @endforeach
    </ul>
@endsection
