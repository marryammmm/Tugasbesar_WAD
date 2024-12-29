<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use Barryvdh\DomPDF\Facade\Pdf; // Namespace DOMPDF


class ReceiptController extends Controller
{
    public function show($id)
    {
        // Ambil data booking berdasarkan ID
        $booking = Booking::with(['address', 'ambulance'])->findOrFail($id);

        // Kirim data ke view
        return view('booking.receipt', compact('booking'));
    }
    public function downloadPDF(Booking $booking)
{
    // Render view ke HTML
    $html = view('booking.receipt', compact('booking'))->render();

    // Generate PDF
    $pdf = Pdf::loadHTML($html)
              ->setPaper('A4', 'portrait'); // Atur ukuran dan orientasi kertas

    // Unduh file PDF
    return $pdf->download('bukti-pemesanan-' . $booking->id . '.pdf');
}

}

