@extends('layouts.app')

@section('content')
    <h1>Create New Article</h1>
    <form action="{{ route('articles.store') }}" method="POST" class="mt-4" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>

        <div class="form-group mt-3">
            <label for="summary">Summary:</label>
            <textarea name="summary" id="summary" class="form-control" required></textarea>
        </div>

        <!-- Image upload field -->
        <div class="form-group mt-3">
            <label for="image">Image Upload:</label>
            <input type="file" name="image" id="image" class="form-control" accept="image/*">
        </div>

        <!-- YouTube video URL input -->
        <div class="form-group mt-3">
            <label for="video_url">Video URL (YouTube only):</label>
            <input type="url" name="video_url" id="video_url" class="form-control" placeholder="Enter YouTube video URL">
        </div>

        <button type="submit" class="btn btn-success mt-4">Submit</button>
    </form>
@endsection
