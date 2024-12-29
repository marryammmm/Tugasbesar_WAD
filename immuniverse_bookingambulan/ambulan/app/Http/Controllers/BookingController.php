<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Ambulance;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    // Menampilkan form input lokasi penjemputan
    public function create()
    {
        $addresses = Address::all(); // Riwayat alamat
        return view('booking.create', compact('addresses'));
    }

    // Memproses pencarian ambulans terdekat
    public function search(Request $request)
    {
        $request->validate(['address' => 'required|string|max:255']);
        $address = Address::firstOrCreate(['address' => $request->address]);

        // Cari ambulans terdekat
        $ambulances = Ambulance::orderBy('distance_in_minutes')->get();

        return view('booking.choose_ambulance', compact('address', 'ambulances'));
    }

    // Menyimpan data pemesanan baru
    public function store(Request $request)
    {
        $request->validate([
            'address_id' => 'required|exists:addresses,id',
            'ambulance_id' => 'required|exists:ambulances,id',
        ]);

        $booking = Booking::create([
            'address_id' => $request->address_id,
            'ambulance_id' => $request->ambulance_id,
            'status' => 'PENDING',
        ]);

        return view('booking.loading', compact('booking'));
    }

    // Membatalkan pesanan jika masih "PENDING"
    public function cancel(Booking $booking)
    {
        if ($booking->status === 'PENDING') {
            $booking->update(['status' => 'CANCELLED']);
        }

        return redirect()->route('booking.create');
    }

    // Menampilkan dan memproses halaman konfirmasi alamat
    public function confirm(Request $request, Booking $booking)
    {
        if ($request->isMethod('GET')) {
            // Tampilkan halaman konfirmasi dengan data booking
            $booking->load('address'); // Pastikan relasi address dimuat
            return view('booking.confirm', compact('booking'));
        }

        if ($request->has('correct')) {
            // Perbarui status booking menjadi "PROCESSING"
            $booking->update(['status' => 'PROCESSING']);
            return view('booking.details', compact('booking'));
        }

        if ($request->has('update_address')) {
            // Validasi dan simpan alamat baru
            $request->validate(['new_address' => 'required|string|max:255']);
            $address = Address::firstOrCreate(['address' => $request->new_address]);
            $booking->update(['address_id' => $address->id]);

            // Redirect kembali ke halaman konfirmasi
            return redirect()->route('booking.confirm', $booking);
        }
    }

    // Menyelesaikan pesanan secara manual
    public function complete(Booking $booking)
    {
        $booking->update(['status' => 'COMPLETED']);
        return view('booking.completed', compact('booking'));
    }

    // Menyelesaikan pesanan secara otomatis setelah waktu habis
    public function autoComplete(Booking $booking)
    {
        if ($booking->status === 'PROCESSING') {
            $booking->update(['status' => 'COMPLETED']);
            return response()->json(['status' => 'success', 'message' => 'Pesanan selesai']);
        }

        return response()->json(['status' => 'error', 'message' => 'Pesanan tidak dapat diselesaikan']);
    }
    public function destroy(Address $address)
{
    // Hapus alamat dari database
    $address->delete();

    // Redirect kembali ke halaman input lokasi
    return redirect()->route('booking.create')->with('success', 'Riwayat alamat berhasil dihapus.');
}

}
