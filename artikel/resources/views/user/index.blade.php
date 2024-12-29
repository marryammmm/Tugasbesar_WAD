@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <h1 class="text-center mb-5 text-success">Daftar Artikel Immuniverse</h1>
        
        <!-- Articles Grid -->
        <div class="row g-4">
            @forelse ($articles as $article)
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm rounded-4 border-0">
                        <!-- Article Image -->
                        @if ($article->image_url)
                            <img src="{{ asset('storage/' . str_replace('public/', '', $article->image_url)) }}" 
                                 alt="{{ $article->title }}" class="card-img-top rounded-top-4 img-fluid">
                        @else
                            <img src="{{ asset('default-image.jpg') }}" 
                                 alt="Default Article Image" class="card-img-top rounded-top-4 img-fluid">
                        @endif

                        <!-- Card Body -->
                        <div class="card-body">
                            <h5 class="card-title text-success">{{ $article->title }}</h5>
                            <p class="card-text text-muted">{{ Str::limit($article->summary, 100, '...') }}</p>
                        </div>

                        <!-- Card Footer -->
                        <div class="card-footer bg-light text-center">
                            <a href="{{ route('user.articles.show', $article->id) }}" class="btn btn-outline-success btn-sm">
                                Baca Selengkapnya
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <p class="text-center text-muted">Belum ada artikel yang tersedia.</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection
