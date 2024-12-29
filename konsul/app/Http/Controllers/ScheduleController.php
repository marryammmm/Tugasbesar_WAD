<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\Doctor;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        $doctors = Doctor::all();  // Ambil semua dokter
        $schedules = Schedule::with('doctor')->get(); // Mengambil jadwal dengan relasi dokter
        return view('Admin.schedule.index', compact('schedules', 'doctors'));
    }

    public function user_index()
    {
        $doctors = Doctor::all();  // Ambil semua dokter
        $schedules = Schedule::with('doctor')->get(); // Mengambil jadwal dengan relasi dokter
        return view('user.schedules.index', compact('schedules'));
    }

    public function show($id)
    {
        // Find the schedule by id
        $schedule = Schedule::with('doctor')->findOrFail($id);

        // Return the schedule details to the user
        return view('user.schedules.show', compact('schedule'));
    }

    public function create()
    {
        $doctors = Doctor::all();  // Ambil semua dokter untuk form tambah jadwal
        return view('Admin.schedule.create', compact('doctors')); // Kirimkan data dokter ke view create
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'doctor_id' => 'required|exists:doctors,id', // Pastikan doctor_id valid
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'day_of_week' => 'required|string',
        ]);

        // Menyimpan data jadwal baru ke dalam database
        Schedule::create([
            'doctor_id' => $request->doctor_id,  // Mengambil doctor_id dari form
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'day_of_week' => $request->day_of_week,
        ]);

        // Mengarahkan kembali ke halaman index dengan pesan sukses
        return redirect()->route('Admin.schedule.index')->with('success', 'Jadwal praktek berhasil ditambahkan');
    }

    public function edit(Schedule $schedule)
    {
        $doctors = Doctor::all(); // Ambil semua dokter untuk form edit jadwal
        return view('Admin.schedule.edit', compact('schedule', 'doctors'));
    }

    public function update(Request $request, $id)
    {
        $schedule = Schedule::findOrFail($id);

        // Validate the request data
        $validatedData = $request->validate([
            'doctor_id' => 'required',
            'start_time' => 'required|date',
            'end_time' => 'required|date',
            'day_of_week' => 'required',
        ]);

        // Update the schedule
        $schedule->update($validatedData);

        // Redirect with success message
        return redirect()->route('schedules.index')->with('success', 'Jadwal berhasil diperbarui');
    }

    public function destroy(Schedule $schedule)
    {
        // Menghapus jadwal praktek
        $schedule->delete();

        // Mengarahkan kembali ke halaman index dengan pesan sukses
        return redirect()->route('Admin.schedule.index')->with('success', 'Jadwal praktek berhasil dihapus');
    }
}
