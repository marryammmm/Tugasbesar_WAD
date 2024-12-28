@extends('layouts.app')

@section('content')
    <h1>Articles</h1>

    <!-- Link to create a new article -->
    <a href="{{ route('articles.create') }}" class="btn btn-primary">Create New Article</a>

    <!-- List of articles -->
    <ul class="list-group mt-4">
        @forelse ($articles as $article)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <div>
                    <!-- Link to view the article -->
                    <span>{{ $article->title }}</span>
                </div>

                <!-- Display the image -->
                @if ($article->image_url)
                    <img src="{{ asset('storage/' . $article->image_url) }}" alt="{{ $article->title }}" class="img-thumbnail" style="width: 100px;">
                @endif

                <div>
                    <!-- Link to edit the article -->
                    <a href="{{ route('articles.edit', $article->id) }}" class="btn btn-sm btn-warning">Edit</a>

                    <!-- Form to delete the article -->
                    <form action="{{ route('articles.destroy', $article->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this article?')">Delete</button>
                    </form>
                </div>
            </li>
        @empty
            <!-- Message when no articles are available -->
            <li class="list-group-item">No articles available.</li>
        @endforelse
    </ul>
@endsection
