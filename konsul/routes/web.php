<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;

// Rute untuk halaman utama (opsional)
Route::get('/', function () {
    return redirect()->route('chat.index');
});

// Rute untuk halaman riwayat chat
Route::get('admin/chat', [ChatController::class, 'index'])->name('chat.index');

// Rute untuk mengirim pesan admin dan memperbarui respon chatbot
Route::post('/chat/send', [ChatController::class, 'sendAndUpdateResponse'])->name('chat.send');

// Rute untuk menghapus percakapan berdasarkan ID
Route::delete('/chat/{id}', [ChatController::class, 'destroy'])->name('chat.destroy');

// Rute untuk mengedit percakapan berdasarkan ID (dengan form)
Route::get('/chat/{id}/edit', [ChatController::class, 'edit'])->name('chat.edit');

// Rute untuk memperbarui percakapan berdasarkan ID
Route::put('/chat/{id}', [ChatController::class, 'update'])->name('chat.update');

//index user
Route::get('chat', [ChatController::class, 'user_index'])->name('user.chat.index');

//controller user
Route::post('/chat/store', [ChatController::class, 'store'])->name('chat.store');

//logika chatbot
use Illuminate\Http\Request;
use App\Models\Conversation;

Route::post('/chat', function (Request $request) {

    // Ambil input dari user
    $userInput = strtolower($request->input('user_input'));
    $response = Conversation::where('user_input','like','%'. $userInput.'%')->first();

    // Jika respons sudah ada di database
    if ($response) {
        $responseMessage = $response->bot_response;
    } else {
        // Jika respons belum ada di database
        $responseMessage = 'Maaf, saya tidak mengerti pertanyaan Anda.';
    }

    // Kembalikan respons JSON
    return response()->json(['response' => $responseMessage]);
});

//konsultasi controller
// routes/web.php
// use App\Http\Controllers\ScheduleController;


// routes/web.php

use App\Http\Controllers\ScheduleController;
Route::resource('admin/schedules', ScheduleController::class);

 Route::prefix('admin')->name('Admin.')->group(function() {
    Route::get('schedule/index', [ScheduleController::class, 'index'])->name('schedule.index');
    Route::get('schedule/create', [ScheduleController::class, 'create'])->name('schedule.create');
    Route::post('schedule', [ScheduleController::class, 'store'])->name('schedule.store');
    Route::get('schedule/{schedule}/update', [ScheduleController::class, 'update'])->name('schedule.update');
    Route::get('schedule/{schedule}/edit', [ScheduleController::class, 'edit'])->name('schedule.edit');
    Route::delete('schedule/{schedule}', [ScheduleController::class, 'destroy'])->name('schedule.destroy');
    

 });

 Route::get('/user/schedules', [ScheduleController::class, 'user_index'])->name('user.schedules.index');
 Route::get('/user/schedules/{id}', [ScheduleController::class, 'show'])->name('user.schedules.show');

 Route::get('/user/schedule/index', [ScheduleController::class, 'index'])->name('schedule.index');








