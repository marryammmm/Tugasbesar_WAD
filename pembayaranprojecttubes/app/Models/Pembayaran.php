<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayaran'; // Nama tabel

    protected $fillable = [
        'konsultasi_id',
        'jumlah',
        'tanggal',
    ];

    // Relasi dengan model Konsultasi
    public function konsultasi()
    {
        return $this->belongsTo(Konsultasi::class);
    }
}