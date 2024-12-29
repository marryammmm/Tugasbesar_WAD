<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    // Menghapus alamat dari database
    public function destroy(Address $address)
    {
        // Hapus alamat
        $address->delete();

        // Redirect kembali ke halaman input lokasi
        return redirect()->route('booking.create')->with('success', 'Riwayat alamat berhasil dihapus.');
    }
}
