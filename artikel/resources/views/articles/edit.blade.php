@extends('layouts.app')

@section('content')
    <h1>Edit Article</h1>
    <form action="{{ route('articles.update', $article->id) }}" method="POST" class="mt-4" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" name="title" id="title" value="{{ $article->title }}" class="form-control" required>
        </div>

        <div class="form-group mt-3">
            <label for="summary">Summary:</label>
            <textarea name="summary" id="summary" class="form-control" required>{{ $article->summary }}</textarea>
        </div>

        <!-- Image upload field -->
        <div class="form-group mt-3">
            <label for="image">Image Upload (Leave blank to keep current):</label>
            <input type="file" name="image" id="image" class="form-control" accept="image/*">
        </div>

        <!-- YouTube video URL input -->
        <div class="form-group mt-3">
            <label for="video_url">Video URL:</label>
            <input type="url" name="video_url" id="video_url" value="{{ $article->video_url }}" class="form-control">
        </div>

        <button type="submit" class="btn btn-success mt-4">Update</button>
    </form>
@endsection
