@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <!-- Heading -->
    <h1 class="text-center mb-4" style="color: #3e4c3b;">Tambah Jadwal Praktek</h1>

    <!-- Back Button -->
    <div class="mb-4">
        <a href="{{ route('schedules.index') }}" class="btn btn-secondary">Kembali</a>
    </div>

    <!-- Menampilkan pesan error -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card p-4" style="background-color: #c4d7c1; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
        <form action="{{ route('Admin.schedule.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="doctor_id" class="form-label">Nama Dokter</label>
                <select class="form-control @error('doctor_id') is-invalid @enderror" id="doctor_id" name="doctor_id" required>
                    <option value="">Pilih Dokter</option>
                    @foreach ($doctors as $doctor)
                        <option value="{{ $doctor->id }}" {{ old('doctor_id') == $doctor->id ? 'selected' : '' }}>
                            {{ $doctor->name }}
                        </option>
                    @endforeach
                </select>
                @error('doctor_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="start_time" class="form-label">Jam Mulai</label>
                <input type="datetime-local" class="form-control @error('start_time') is-invalid @enderror" id="start_time" name="start_time" required>
                @error('start_time')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="end_time" class="form-label">Jam Selesai</label>
                <input type="datetime-local" class="form-control @error('end_time') is-invalid @enderror" id="end_time" name="end_time" required>
                @error('end_time')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="day_of_week" class="form-label">Hari</label>
                <input type="text" class="form-control @error('day_of_week') is-invalid @enderror" id="day_of_week" name="day_of_week" required>
                @error('day_of_week')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Tambah Jadwal</button>
        </form>
    </div>
</div>
@endsection

<!-- Styling -->
<style>
    body {
        background-color: #faf3e0; /* Beige background */
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }

    .container {
        flex: 1;
    }

    .card {
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        background-color: #c4d7c1; /* Sage background for card */
    }

    .btn-secondary {
        background-color: #6c757d;
        color: #fff;
        border-radius: 5px;
        padding: 10px 20px;
    }

    .btn-secondary:hover {
        background-color: #5a6268;
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

    .alert-danger {
        background-color: #f8d7da;
        border-color: #f5c6cb;
        color: #721c24;
    }

    .alert-danger ul {
        padding-left: 20px;
    }

    .form-control.is-invalid {
        border-color: #dc3545;
    }

    .invalid-feedback {
        color: #dc3545;
    }
</style>
