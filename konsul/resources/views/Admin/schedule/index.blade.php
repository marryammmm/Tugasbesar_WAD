@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <!-- Heading -->
    <h1 class="text-center mb-4" style="color: #3e4c3b;">Daftar Jadwal Praktik Dokter</h1>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    <!-- Button to Add New Schedule -->
    <div class="mb-3 text-center">
        <a href="{{ route('schedules.create') }}" class="btn btn-primary">Tambah Jadwal Praktik</a>
    </div>

    <!-- Table to Display Schedules -->
    <div class="card p-4" style="background-color: #c4d7c1;">
        <h4 class="text-center mb-4">Jadwal Praktik Dokter</h4>
        
        <!-- Schedule Table -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Dokter</th>
                    <th>Hari</th>
                    <th>Jam Mulai</th>
                    <th>Jam Selesai</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($schedules as $index => $schedule)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $schedule->doctor->name }}</td>
                        <td>{{ $schedule->day_of_week }}</td>
                        <td>{{ $schedule->start_time }}</td>
                        <td>{{ $schedule->end_time }}</td>
                        <td>
                            <!-- Edit and Delete buttons -->
                            <a href="{{ route('schedules.edit', $schedule->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('schedules.destroy', $schedule->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus jadwal ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

<!-- Footer -->
<div class="footer">
    <div class="container text-center py-3">
    </div>
</div>

<style>
    body {
        background-color: #faf3e0; /* Beige background */
        display: flex;
        flex-direction: column;
        min-height: 100vh; /* Ensure full page height */
    }

    .container {
        flex: 1;
    }

    .card {
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .footer {
        background-color: #f8f9fa;
        padding: 20px 0;
        position: relative;
        width: 100%;
        bottom: 0;
        margin-top: auto;
    }

    .btn-primary {
        background-color: #007bff;
        color: #fff;
        border-radius: 5px;
        padding: 12px 20px;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    .btn-success {
        background-color: #28a745;
        color: #fff;
    }

    .btn-success:hover {
        background-color: #218838;
    }

    .btn-warning {
        background-color: #ffc107;
        color: #fff;
    }

    .btn-warning:hover {
        background-color: #e0a800;
    }

    .btn-danger {
        background-color: #dc3545;
        color: #fff;
    }

    .btn-danger:hover {
        background-color: #c82333;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .btn-lg {
            font-size: 14px;
        }

        .card {
            padding: 15px;
        }

        .footer p {
            font-size: 14px;
        }
    }
</style>
