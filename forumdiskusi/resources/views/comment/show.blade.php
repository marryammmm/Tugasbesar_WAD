@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-success mb-4"><i class="fas fa-comment-alt"></i> {{ $forum->judul }}</h1>
    <p>{{ $forum->deskripsi }}</p>
    <small>Dibuat oleh: <strong>{{ $forum->creator->name }}</strong> | {{ $forum->created_at->format('d M Y') }}</small>

    <hr>

    <h2 class="text-success"><i class="fas fa-paper-plane"></i> Postingan</h2>
    <a href="{{ route('posts.create', $forum->id) }}" class="btn btn-success-custom mb-3"><i class="fas fa-plus"></i> Tambah Postingan</a>

    <div class="list-group">
        @forelse ($forum->posts as $post)
            <div class="list-group-item bg-success-light mb-2">
                <h5 class="text-success"><i class="fas fa-user-circle"></i> {{ $post->user->name }}</h5>
                <p>{{ $post->content }}</p>
                <small>{{ $post->created_at->format('d M Y H:i') }}</small>
            </div>
        @empty
            <p class="text-center text-muted">Belum ada postingan dalam forum ini.</p>
        @endforelse
    </div>
</div>
@endsection
