<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the pembayaran.
     */
    public function index()
    {
        $pembayarans = Pembayaran::with('konsultasi')->get(); // Assuming you have a relationship defined
        return view('pembayaran.index', compact('pembayarans'));
    }

    /**
     * Show the form for creating a new pembayaran.
     */
    public function create()
    {
        return view('pembayaran.create'); // Create view for payment
    }

    /**
     * Store a newly created pembayaran in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'konsultasi_id' => 'required|exists:konsultasi,id',
            'jumlah' => 'required|numeric',
            'tanggal' => 'required|date',
        ]);

        Pembayaran::create($request->all());

        return redirect()->route('pembayaran.index')->with('success', 'Pembayaran berhasil ditambahkan.');
    }

    /**
     * Display the specified pembayaran.
     */
    public function show(Pembayaran $pembayaran)
    {
        return view('pembayaran.show', compact('pembayaran'));
    }

    /**
     * Show the form for editing the specified pembayaran.
     */
    public function edit(Pembayaran $pembayaran)
    {
        return view('pembayaran.edit', compact('pembayaran'));
    }

    /**
     * Update the specified pembayaran in storage.
     */
    public function update(Request $request, Pembayaran $pembayaran)
    {
        $request->validate([
            'jumlah' => 'required|numeric',
            'tanggal' => 'required|date',
        ]);

        $pembayaran->update($request->all());

        return redirect()->route('pembayaran.index')->with('success', 'Pembayaran berhasil diperbarui.');
    }

    /**
     * Remove the specified pembayaran from storage.
     */
    public function destroy(Pembayaran $pembayaran)
    {
        $pembayaran->delete();

        return redirect()->route('pembayaran.index')->with('success', 'Pembayaran berhasil dihapus.');
    }
}