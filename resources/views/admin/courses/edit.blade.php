<!-- resources/views/admin/courses/edit.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Edit Course</h1>

    <form action="{{ route('course.update', $course) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title">Course Title</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $course->title) }}" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" class="form-control" required>{{ old('description', $course->description) }}</textarea>
        </div>

        <div class="form-group">
            <label for="duration">Duration</label>
            <input type="text" name="duration" class="form-control" value="{{ old('duration', $course->duration) }}" required>
        </div>

        <div class="form-group">
            <label for="price">Price</label>
            <input type="text" name="price" class="form-control" value="{{ old('price', $course->price) }}" required>
        </div>

        <div class="form-group">
            <label for="instructor_id">Instructor</label>
            <select name="instructor_id" class="form-select" required>
                @foreach($instructors as $instructor)
                    <option value="{{ $instructor->id }}" {{ old('instructor_id', $course->instructor_id) == $instructor->id ? 'selected' : '' }}>{{ $instructor->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update Course</button>
    </form>
</div>
@endsection
