@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <!-- Heading -->
    <h1 class="text-center mb-4" style="color: #3e4c3b;">Tambah Dokter Baru</h1>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    <!-- Form Input for Doctor -->
    <div class="card mt-5 p-4" style="background-color: #c4d7c1;">
        <h4 class="text-center mb-4">Input Data Dokter</h4>
        <form action="{{ route('doctors.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Nama Dokter</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="Nama Dokter" value="{{ old('name') }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="specialization" class="form-label">Spesialisasi</label>
                <input type="text" class="form-control @error('specialization') is-invalid @enderror" name="specialization" id="specialization" placeholder="Spesialisasi" value="{{ old('specialization') }}" required>
                @error('specialization')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="phone_number" class="form-label">Nomor Telepon</label>
                <input type="text" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" id="phone_number" placeholder="Nomor Telepon" value="{{ old('phone_number') }}" required>
                @error('phone_number')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="Email" value="{{ old('email') }}" required>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-success btn-lg w-100">Tambah Dokter</button>
        </form>
    </div>
</div>
@endsection

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

    /* Ensure that the form and buttons are responsive */
    @media (max-width: 768px) {
        .btn-lg {
            font-size: 14px;
        }

        .card {
            padding: 15px;
        }
    }
</style>
