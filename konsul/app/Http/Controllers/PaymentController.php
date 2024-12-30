<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the payment.
     */
    public function index()
    {
        $payments = Payment::with('konsultasi')->get(); // Assuming you have a relationship defined
        return view('payment', compact('payments'));
        return response()->json(['message' => 'PaymentController works!']);
    }
    public function user_index()
    {
        $payments = Payment::with('doctor')->get(); // Mengambil jadwal dengan relasi dokter
        return view('user.payments.index', compact('payments'));
    }

    /**
     * Show the form for creating a new payment.
     */
    public function create()
    {
        return view('payment.create'); // Create view for payment
    }

    /**
     * Store a newly created payment in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'total' => 'required|numeric',
            'date' => 'required|date',
        ]);

        Payment::create($request->all());

        return redirect()->route('payment.index')->with('success', 'Payment berhasil ditambahkan.');
    }

    public function show($id)
    {
        // Find the payment by id
        $payment = Payment::with('doctor')->findOrFail($id);

        // Return the payment details to the user
        return view('user.payments.show', compact('payment'));
    }


    /**
     * Show the form for editing the specified payment.
     */
    public function edit(Payment $payment)
    {
        return view('payment.edit', compact('payment'));
    }

    /**
     * Update the specified payment in storage.
     */
    public function update(Request $request, Payment $payment)
    {
        $request->validate([
            'total' => 'required|numeric',
            'date' => 'required|date',
        ]);

        $payment->update($request->all());

        return redirect()->route('payment.index')->with('success', 'Payment berhasil diperbarui.');
    }

    /**
     * Remove the specified payment from storage.
     */
    public function destroy(Payment $payment)
    {
        $payment->delete();

        return redirect()->route('payment.index')->with('success', 'Payment berhasil dihapus.');
    }
}