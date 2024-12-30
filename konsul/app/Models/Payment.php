<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $table = 'payment'; // Nama tabel

    protected $fillable = [
        'total',
        'date',
    ];

    // Relasi dengan model Konsultasi
    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }
}