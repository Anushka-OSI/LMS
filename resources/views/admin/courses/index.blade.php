<!-- resources/views/admin/courses/index.blade.php -->

@extends('layouts.admin')

@section('content')
<div class="container">
    <h1 class="mb-4">Courses</h1>
    <a href="{{ route('course.create') }}" class="btn btn-primary mb-3">Add New Course</a>
    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Instructor</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($courses as $course)
            <tr>
                <td>{{ $course->title }}</td>
                <td>{{ $course->description }}</td>
                <td>{{ $course->instructor->name }}</td>
                <td>
                    <a href="{{ route('course.edit', $course) }}" class="btn btn-warning btn-sm">Edit</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
