@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <!-- Heading -->
    <h1 class="text-center mb-4" style="color: #3e4c3b;">Daftar Jadwal Praktik Dokter</h1>

    <!-- Table to Display Schedules -->
    <div class="card p-4" style="background-color: #f1f8e9; border-radius: 10px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);">
        <h4 class="text-center mb-4">Jadwal Praktik Dokter</h4>

        <!-- Empty State Message -->
        @if($schedules->isEmpty())
            <p class="text-center">Tidak ada jadwal yang tersedia.</p>
        @else
            <!-- Schedule Table -->
            <table class="table table-bordered table-striped table-hover table-sm">
                <thead class="thead-light">
                    <tr>
                        <th>No</th>
                        <th>ID Konsultasi</th>
                        <th>Jumlah</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($payments as $index => $payment)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $payment->doctor->name }}</td> <!-- Assuming doctor has a 'name' attribute -->
                            <td>{{ $payment->day_of_week }}</td>
                            <td>{{ \Carbon\Carbon::parse($payment->start_time)->format('H:i') }}</td>
                            <td>{{ \Carbon\Carbon::parse($payment->end_time)->format('H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
@endsection

<style>
    body {
        background-color: #faf3e0; /* Beige background */
        display: flex;
        flex-direction: column;
        height: 100vh;
        margin: 0;
    }

    .container {
        flex: 1;
    }

    .card {
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .footer {
        background-color: #f8f9fa;
        position: fixed;
        bottom: 0;
        width: 100%;
        text-align: center;
        padding: 10px 0;
        box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.1);
    }

    table th, table td {
        text-align: center;
        vertical-align: middle;
    }

    table td {
        font-size: 14px;
    }

    table th {
        background-color: #28a745;
        color: #fff;
    }

    .btn {
        border-radius: 5px;
    }

    .btn-primary {
        background-color: #007bff;
        color: #fff;
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

    /* Make the table responsive */
    @media (max-width: 768px) {
        table {
            font-size: 12px;
        }

        .card {
            padding: 15px;
        }
    }
</style>

<div class="footer">
    <p>&copy; {{ date('Y') }} - Praktik Dokter</p>
</div>
