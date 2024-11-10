{{-- resources/views/student/online-classes.blade.php --}}

@extends('layouts.student')

@section('content')

<h1 class="text-center mb-4">My Online Classes</h1>

<!-- Display all courses the student is enrolled in -->
@foreach ($courses as $course)
    <div class="course mb-5 p-4 border rounded shadow-sm" style="background-color: #f8f9fa;">
        <h3 class="text-primary">{{ $course->title }}</h3>
        <p class="text-muted">{{ $course->description }}</p>

        <!-- Display online classes for this course -->
        <h4 class="mt-4">Online Classes:</h4>
        <ul class="list-group list-group-flush">
            @foreach ($onlineClasses->where('course_id', $course->id) as $onlineClass)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <p><strong>Link:</strong> <a href="{{ $onlineClass->link }}" target="_blank" class="text-info">{{ $onlineClass->link }}</a></p>
                        <p><strong>Description:</strong> {{ $onlineClass->description }}</p>
                    </div>
                    <span class="badge bg-{{ $onlineClass->status ? 'success' : 'warning' }} text-dark">
                        {{ $onlineClass->status ? 'Finished' : 'Not Finished' }}
                    </span>
                </li>
            @endforeach
        </ul>
    </div>
@endforeach

@endsection

