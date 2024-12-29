@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <!-- Article Card -->
        <div class="card shadow-sm rounded-4 border-0">
            <!-- Card Header -->
            <div class="card-header bg-success text-white text-center py-3 rounded-4">
                <h2 class="display-5">{{ $article->title }}</h2>
            </div>

            <!-- Card Body -->
            <div class="card-body">
                <!-- Image Display (above the summary) -->
                @if ($article->image_url)
                    <div class="mb-4 text-center">
                        <img src="{{ asset('storage/' . str_replace('public/', '', $article->image_url)) }}" 
                             alt="{{ $article->title }}" class="img-fluid rounded-4 shadow-sm">
                    </div>
                @endif

                <!-- Article Summary -->
                <p class="lead text-muted">{{ $article->summary }}</p>

                <!-- Video Link (YouTube) -->
                @if ($article->video_url)
                    <div class="text-center mt-4">
                        <a href="{{ $article->video_url }}" target="_blank" class="btn btn-primary btn-lg shadow-sm">Watch Video</a>
                    </div>
                @endif
            </div>

            <!-- Card Footer -->
            <div class="card-footer bg-light text-center py-3">
                <p class="mb-0 text-muted">Artikel Immuniverse - &copy; 2024</p>
            </div>
        </div>
    </div>
@endsection
