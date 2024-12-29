<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\ReceiptController;
Route::get('/booking/create', [BookingController::class, 'create'])->name('booking.create');
Route::post('/booking/search', [BookingController::class, 'search'])->name('booking.search');
Route::post('/booking/store', [BookingController::class, 'store'])->name('booking.store');
Route::post('/booking/{booking}/cancel', [BookingController::class, 'cancel'])->name('booking.cancel');
Route::get('/booking/{booking}/confirm', [BookingController::class, 'confirm'])->name('booking.confirm');
Route::post('/booking/{booking}/confirm', [BookingController::class, 'confirm'])->name('booking.confirm.post');
Route::get('/booking/{booking}/complete', [BookingController::class, 'complete'])->name('booking.complete');
Route::post('/booking/{booking}/auto-complete', [BookingController::class, 'autoComplete'])->name('booking.auto_complete');
Route::delete('/address/{address}', [AddressController::class, 'destroy'])->name('address.destroy');
// Rute untuk halaman Receipt
Route::get('/booking/{booking}/receipt', [ReceiptController::class, 'show'])->name('booking.receipt');
Route::get('/booking/{booking}/receipt/download', [ReceiptController::class, 'downloadPDF'])->name('booking.receipt.download');