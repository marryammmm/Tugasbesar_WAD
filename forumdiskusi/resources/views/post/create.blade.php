@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-success mb-4"><i class="fas fa-plus"></i> Tambah Postingan</h1>

    <div class="card p-4 bg-success-light">
        <form action="{{ route('post.store', $forum->id) }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="content" class="form-label">Isi Postingan</label>
                <textarea class="form-control" id="content" name="content" rows="5" required></textarea>
            </div>
            <button type="submit" class="btn btn-success-custom"><i class="fas fa-save"></i> Kirim</button>
        </form>
    </div>
</div>
@endsection
