@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center text-dark mb-4">
            <i class="fas fa-comments text-success"></i> Forum Diskusi
        </h1>

        <div class="row">
            <div class="col-md-9">
                <!-- Search bar -->
                <div class="header-top">
                    <div class="input-group mb-4">
                        <input type="text" class="form-control rounded-pill" placeholder="Type here to search" />
                    </div>
                    <div class="col-md-4 text-md-end mt-3 mt-md-0">
                        <a href="{{ route('forum.create') }}" class="btn btn-outline-success w-100 rounded-pill">
                            Buat Forum
                        </a>
                    </div>
                </div>
                <br>
                <!-- Tabel forum -->
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="table-success">
                            <tr>
                                <th>Id</th>
                                <th>Judul Forum</th>
                                <th>Deskripsi</th>
                                <th>Created by</th>
                                <th>Created at</th>
                                <th>Updated at</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($forums as $forum)
                                <tr>
                                    <td>{{ $forum->id }}</td>
                                    <td>{{ $forum->judul }}</td>
                                    <td>{{ $forum->deskripsi }}</td>
                                    <td>{{ $forum->pengguna->username }}</td>
                                    <td>{{ $forum->created_at }}</td>
                                    <td>{{ $forum->updated_at }}</td>
                                    <td>
                                        <a href="{{ route('forum.show', $forum->id) }}" class="btn btn-success btn-sm mt-2">
                                            <i class="fas fa-arrow-right"></i> Lihat
                                        </a>
                                        @if (session('user_id') && (session('user_id') == $forum->created_by))
                                            <form action="{{ route('forum.destroy', $forum->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm mt-2"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus forum ini?')">
                                                    <i class="fas fa-trash"></i> Hapus
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Kolom kanan -->
            <div class="col-md-3">
                <!-- Forum Stats -->
                <div class="card shadow-sm sticky-top" style="top: 20px;">
                    <div class="card-header bg-success text-white text-center rounded-top">
                        <i class="fas fa-chart-bar"></i> Forum Stats
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled">
                            <li class="mb-3">
                                <span class="text-success"><i class="fas fa-users"></i> Users</span>:
                                {{ $stats['pengguna'] }}
                            </li>
                            <li class="mb-3">
                                <span class="text-success"><i class="fas fa-folder"></i> Forums</span>:
                                {{ $stats['forums'] }}
                            </li>
                            <li class="mb-3">
                                <span class="text-success"><i class="fas fa-pencil-alt"></i> Posts</span>:
                                {{ $stats['posts'] }}
                            </li>
                            <li>
                                <span class="text-success"><i class="fas fa-comment"></i> Comments</span>:
                                {{ $stats['comments'] }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
