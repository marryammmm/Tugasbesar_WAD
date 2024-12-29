<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'address_id', 
        'ambulance_id', 
        'status', 
        'created_at', // Tanggal pemesanan
    ];

    /**
     * Relasi ke tabel Address
     */
    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    /**
     * Relasi ke tabel Ambulance
     */
    public function ambulance()
    {
        return $this->belongsTo(Ambulance::class);
    }

    /**
     * Format created_at untuk tampil pada halaman Receipt
     */
    public function getFormattedCreatedAtAttribute()
    {
        return $this->created_at->format('d M Y H:i'); // Contoh: 29 Dec 2024 14:30
    }
}
