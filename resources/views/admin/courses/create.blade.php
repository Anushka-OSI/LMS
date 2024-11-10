<!-- resources/views/admin/courses/create.blade.php -->

@extends('layouts.admin')

@section('content')
<div class="container">
    <h1 class="mb-4">Add New Course</h1>

    <form action="{{ route('course.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="title">Course Title</label>
            <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" class="form-control" required>{{ old('description') }}</textarea>
        </div>

        <div class="form-group">
            <label for="duration">Duration</label>
            <input type="text" name="duration" class="form-control" value="{{ old('duration') }}" required>
        </div>

        <div class="form-group">
            <label for="price">Price</label>
            <input type="text" name="price" class="form-control" value="{{ old('price') }}" required>
        </div>

        <div class="form-group">
            <label for="instructor_id">Instructor</label>
            <select name="instructor_id" class="form-select" required>
                @foreach($instructors as $instructor)
                    <option value="{{ $instructor->id }}" {{ old('instructor_id') == $instructor->id ? 'selected' : '' }}>{{ $instructor->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Create Course</button>
    </form>
</div>
@endsection
