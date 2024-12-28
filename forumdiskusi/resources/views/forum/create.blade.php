@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="text-success text-center"><i class="fas fa-plus-circle"></i> Buat Forum Baru</h2>
    <p class="text-muted text-center">Isi formulir di bawah ini untuk membuat forum diskusi baru.</p>

    <div class="card shadow-sm mt-4">
        <div class="card-body">
            <form action="{{ route('forum.store') }}" method="POST">
                @csrf
                <div class="form-group mb-4">
                    <label for="judul" class="form-label text-success">Judul Forum</label>
                    <input type="text" name="judul" id="judul" class="form-control rounded-pill" placeholder="Masukkan judul forum" required>
                </div>

                <div class="form-group mb-4">
                    <label for="deskripsi" class="form-label text-success">Deskripsi Forum</label>
                    <textarea name="deskripsi" id="deskripsi" class="form-control rounded" rows="4" placeholder="Tulis deskripsi forum..." required></textarea>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-success rounded-pill px-4">
                        <i class="fas fa-save"></i> Simpan Forum
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection