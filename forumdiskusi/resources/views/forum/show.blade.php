@extends('layouts.app')

@section('content')
    <div class="container">
        <!-- Forum Title and Description -->
        <div class="mb-5">
            <h1 class="text-success mb-3"><i class="fas fa-comment-alt"></i> {{ $forum->judul }}</h1>
            <p class="lead">{{ $forum->deskripsi }}</p>
            <small class="text-muted">Dibuat oleh: <strong>{{ $forum->pengguna->full_name }}</strong> | {{ $forum->created_at->format('d M Y') }}</small>
        </div>

        <hr class="my-4">

        <!-- Post Creation Section -->
        <h2 class="text-success mb-4"><i class="fas fa-paper-plane"></i> Postingan</h2>
        
        @if (session('user'))
            <a href="{{ route('post.create', $forum->id) }}" class="btn btn-success mb-4"><i class="fas fa-plus"></i> Tambah Postingan</a>
        @else
            <p class="text-muted mb-4">You need to be logged in to create a post.</p>
        @endif

        <!-- Posts List -->
        <div class="list-group">
            @forelse ($forum->posts as $post)
                <div class="list-group-item border rounded mb-3">
                    <!-- Post Information -->
                    <div class="d-flex justify-content-between">
                        <h5 class="mb-1 text-success"><i class="fas fa-user-circle"></i> {{ $post->user->full_name }}</h5>
                        <small class="text-muted">{{ $post->created_at->format('d M Y H:i') }}</small>
                    </div>
                    <p class="mt-2">{{ $post->content }}</p>

                    <!-- Edit/Delete Post (only if user is the creator of the post) -->
                    @if (session('user') && session('user'))
                        <div class="d-flex justify-content-end">
                            <form action="{{ route('post.destroy', $post->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this post?')" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i> Hapus</button>
                            </form>
                        </div>
                    @endif

                    <!-- Comment Form -->
                    @if (session('user'))
                        <form action="{{ route('comment.store', $post->id) }}" method="POST" class="mt-4">
                            @csrf
                            <div class="form-group">
                                <textarea name="content" class="form-control" rows="3" placeholder="Tulis komentar..." required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm mt-2">Kirim Komentar</button>
                        </form>
                    @else
                        <p class="text-muted mt-3">You need to be logged in to comment.</p>
                    @endif

                    <!-- Display Comments -->
                    @if ($post->comments->count() > 0)
                        <hr class="my-3">
                        <div class="comments-list">
                            @foreach ($post->comments as $comment)
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $comment->user->full_name }}</h5>
                                        <p class="card-text">{{ $comment->content }}</p>
                                        <small class="text-muted">Diposting pada: {{ $comment->created_at->format('d M Y H:i') }}</small>

                                        <!-- Edit/Delete Comment (only if user is the creator of the comment) -->
                                        @if (session('user->id') && session('user->id') == $comment->pengguna_id)
                                            <div class="d-flex justify-content-end">
                                                <form action="{{ route('comment.destroy', $comment->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this comment?')" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i> Hapus </button>
                                                </form>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted mt-3">Belum ada komentar di postingan ini.</p>
                    @endif
                </div>
            @empty
                <p class="text-center text-muted">Belum ada postingan dalam forum ini.</p>
            @endforelse
        </div>
    </div>
@endsection
