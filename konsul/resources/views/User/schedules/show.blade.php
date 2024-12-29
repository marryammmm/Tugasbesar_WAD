@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <!-- Heading -->
    <h1 class="text-center mb-4" style="color: #3e4c3b;">Detail Jadwal Praktik Dokter</h1>

    <!-- Schedule Details -->
    <div class="card p-4" style="background-color: #c4d7c1;">
        <h4 class="text-center mb-4">Jadwal Praktik Dokter</h4>

        <!-- Schedule Information -->
        <div class="mb-3">
            <strong>Nama Dokter:</strong>
            <p>{{ $schedule->doctor->name }}</p>
        </div>
        <div class="mb-3">
            <strong>Hari:</strong>
            <p>{{ $schedule->day_of_week }}</p>
        </div>
        <div class="mb-3">
            <strong>Jam Mulai:</strong>
            <p>{{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }}</p>
        </div>
        <div class="mb-3">
            <strong>Jam Selesai:</strong>
            <p>{{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}</p>
        </div>
        
        <!-- Back to schedule list button -->
        <div class="text-center mt-4">
            <a href="{{ route('user.schedules.index') }}" class="btn btn-primary">Kembali ke Daftar Jadwal</a>
        </div>
    </div>
</div>
@endsection

<!-- Footer -->
<div class="footer mt-auto py-3 text-center" style="background-color: #f8f9fa;">
    <p>&copy; {{ date('Y') }} - Praktik Dokter</p>
</div>

<style>
    body {
        background-color: #faf3e0; /* Beige background */
        display: flex;
        flex-direction: column;
        height: 100vh;
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
        position: relative;
        bottom: 0;
        width: 100%;
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
</style>
