@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center mb-4">Edit Jadwal Praktek</h1>

    <form action="{{ route('Admin.schedule.update', $schedule->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-3">
            <label for="doctor_id" class="form-label">Nama Dokter</label>
            <select class="form-select" id="doctor_id" name="doctor_id" required>
                @foreach($doctors as $doctor)
                    <option value="{{ $doctor->id }}" {{ $doctor->id == $schedule->doctor_id ? 'selected' : '' }}>{{ $doctor->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="start_time" class="form-label">Jam Mulai</label>
            <input type="datetime-local" class="form-control" id="start_time" name="start_time" value="{{ \Carbon\Carbon::parse($schedule->start_time)->format('Y-m-d\TH:i') }}" required>
        </div>        

        <div class="mb-3">
            <label for="end_time" class="form-label">Jam Selesai</label>
            <input type="datetime-local" class="form-control" id="end_time" name="end_time" value="{{ $schedule->end_time->format('Y-m-d\TH:i') }}" required>
        </div>

        <div class="mb-3">
            <label for="day_of_week" class="form-label">Hari</label>
            <input type="text" class="form-control" id="day_of_week" name="day_of_week" value="{{ $schedule->day_of_week }}" required>
        </div>

        <button type="submit" class="btn btn-warning">Update Jadwal</button>
    </form>
</div>
@endsection
