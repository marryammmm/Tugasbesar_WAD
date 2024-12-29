<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = ['doctor_id', 'day_of_week', 'start_time', 'end_time'];

    // Tambahkan ini untuk memastikan start_time diperlakukan sebagai tanggal
    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];

    // Relasi ke model Doctor
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}
