@extends('layouts.instructor')

@section('content')
    <div class="container">
        <h1>My Courses</h1>
        {{-- <a href="{{ route('instructor.createCourse') }}" class="btn btn-primary">Create New Course</a> --}}

        @if ($courses->isEmpty())
            <p>No courses found.</p>
        @else
            <ul class="list-group mt-3">
                @if($courses && $courses->count() > 0)
    @foreach($courses as $course)
        <li class="list-group-item">
            <h4>{{ $course->title }}</h4>
            <p>{{ $course->description }}</p>
            <p><strong>Duration:</strong> {{ $course->duration }}</p>
            <p><strong>Price:</strong> {{ $course->price }}</p>
            <a href="{{ route('instructor.uploadAssignment', $course->id) }}" class="btn btn-secondary">Upload Assignment</a>
        </li>
    @endforeach
@else
    <p>No courses available.</p>
@endif


            </ul>
        @endif
    </div>
@endsection
