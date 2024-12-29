<?php

use App\Http\Controllers\PembayaranController;

Route::middleware(['auth'])->group(function () {
    Route::resource('pembayaran', PembayaranController::class);
});