@extends('layouts.instructor')

@section('content')
    <div class="container">
        <h1>Upload Assignment for {{ $course->title }}</h1>

        <!-- Form to upload assignment -->
        <form action="{{ route('instructor.storeAssignment', $course->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Assignment Title</label>
                <input type="text" name="title" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" class="form-control"></textarea>
            </div>

            <div class="form-group">
                <label for="file">Assignment File (PDF, DOC, DOCX, PPT, PPTX)</label>
                <input type="file" name="file" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Upload Assignment</button>
        </form>
    </div>
@endsection
