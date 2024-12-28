@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-success mb-4"><i class="fas fa-comments"></i> Daftar Forum Diskusi</h1>
    <a href="{{ route('forum.create') }}" class="btn btn-success mb-3"><i class="fas fa-plus"></i> Buat Forum Baru</a>

    <div class="row">
        @forelse ($forums as $forum)
        <div class="col-md-4">
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h5 class="text-success"><i class="fas fa-comment-alt"></i> {{ $forum->judul }}</h5>
                    <p class="text-muted">{{ Str::limit($forum->deskripsi, 100) }}</p>
                    <small>Dibuat oleh: <strong>{{ $forum->pengguna->nama }}</strong></small><br>
                    <small>{{ $forum->created_at->format('d M Y Y') }}</small>
                    <a href="{{ route('forum.show', $forum->id) }}" class="btn btn-success btn-sm mt-2"><i class="fas fa-arrow-right"></i> Lihat Detail</a>
                </div>
            </div>
        </div>
        @empty
        <p class="text-center text-muted">Tidak ada forum yang tersedia.</p>
        @endforelse
    </div>
</div>
@endsection