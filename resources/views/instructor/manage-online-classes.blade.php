{{-- resources/views/instructor/manage-online-classes.blade.php --}}

@extends('layouts.instructor')

<style>
    li {
        list-style: none;
    }
</style>

@section('content')
    <h1>Manage Online Classes</h1>

    <!-- Display all courses belonging to the instructor -->
    <div class="mb-4">
        <ul class="list-group">
            @foreach ($courses as $course)
                <li class="list-group-item my-2 p-2" style="background-color: rgb(255, 255, 213)">
                    <h4>{{ $course->title }}</h4>
                    <p>{{ $course->description }}</p>

                    <!-- Online Classes for each course -->
                    <h5>Online Classes:</h5>
                    <ul class="list-group">
                        @foreach ($onlineClasses->where('course_id', $course->id) as $onlineClass)
                            <li class="list-group-item my-2" style="background-color: rgb(240, 240, 240)">
                                <p><strong>Link:</strong> <a href="{{ $onlineClass->link }}"
                                        target="_blank">{{ $onlineClass->link }}</a></p>
                                <p><strong>Description:</strong> {{ $onlineClass->description }}</p>
                                <p><strong>Status:</strong> {{ $onlineClass->status ? 'Finished' : 'Not Finished' }}</p>

                                <!-- Update Status -->
                                <form action="{{ route('instructor.updateOnlineClassStatus', $onlineClass->id) }}"
                                    method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="btn btn-sm {{ $onlineClass->status ? 'btn-danger' : 'btn-success' }}">
                                        Mark as {{ $onlineClass->status ? 'Not Finished' : 'Finished' }}
                                    </button>
                                    <a href="{{ route('instructor.deleteOnlineClass', $onlineClass->id) }}"
                                        onclick="return confirm('Are you sure you want to delete this online class?')"
                                        class="btn btn-sm btn-danger ml-2">Delete</a>
                                </form>

                                <!-- Delete Online Class -->
                            </li>
                        @endforeach
                    </ul>

                    <!-- Add New Online Class Form -->
                    <form action="{{ route('instructor.storeOnlineClass', $course->id) }}" method="POST" class="mt-3">
                        @csrf
                        <h5>Add a New Online Class</h5>
                        <div class="form-group">
                            <label for="link">Class Link</label>
                            <input type="url" name="link" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Class Description</label>
                            <textarea name="description" class="form-control" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary mt-2">Add Online Class</button>
                    </form>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
