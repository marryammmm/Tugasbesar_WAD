@extends('layouts.app')
@section('content')
<div class="container mt-5">
    <h2 class="text-success text-center"><i class="fas fa-edit"></i> Edit Forum</h2>
    <p class="text-muted text-center">Perbarui formulir di bawah ini untuk mengubah forum diskusi.</p>
    <div class="card shadow-sm mt-4">
        <div class="card-body">
            <form action="{{ route('forum.update', $forum->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="form-group mb-4">
                    <label for="judul" class="form-label text-success">Judul Forum</label>
                    <input type="text" name="judul" id="judul" class="form-control rounded-pill" 
                        value="{{ old('judul', $forum->judul) }}" placeholder="Masukkan judul forum" required>
                </div>

                <div class="form-group mb-4">
                    <label for="deskripsi" class="form-label text-success">Deskripsi Forum</label>
                    <textarea name="deskripsi" id="deskripsi" class="form-control rounded" rows="4" 
                        placeholder="Tulis deskripsi forum..." required>{{ old('deskripsi', $forum->deskripsi) }}</textarea>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-success rounded-pill px-4">
                        <i class="fas fa-save"></i> Perbarui Forum
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection