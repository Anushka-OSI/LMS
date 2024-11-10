<!-- resources/views/instructor/assignments.blade.php -->

@extends('layouts.instructor')

@section('content')
<div class="container">
    <h2>Assignments</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($assignments->isEmpty())
        <p>No assignments found for your courses.</p>
    @else
        <ul class="list-group">
            @foreach($assignments as $assignment)
                <li class="list-group-item my-3" style="background-color: rgb(255, 255, 200)">
                    <h4>{{ $assignment->title }}</h4>
                    <p><strong>Course:</strong> {{ $assignment->course->title }}</p>
                    <p><strong>Due Date:</strong> {{ $assignment->created_at->diffForHumans() }}</p>
                    <p><strong>Description:</strong> {{ $assignment->description }}</p>
                    <a target="_blank" href="{{ asset('storage/' . $assignment->file_path) }}" class="btn btn-secondary">Documents</a>

                </li>
            @endforeach
        </ul>
    @endif

    {{-- <a href="{{ route('instructor.uploadAssignmentForm') }}" class="btn btn-primary mt-4">Upload New Assignment</a> --}}
</div>
@endsection
