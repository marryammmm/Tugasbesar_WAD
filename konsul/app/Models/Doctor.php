<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    // Tentukan tabel yang digunakan
    protected $table = 'users'; // Menggunakan tabel 'users' jika Doctor adalah User

    // Tentukan kolom yang bisa diisi
    protected $fillable = [
        'name',
        'email',
        'password', // jika dokter juga menggunakan password untuk autentikasi
    ];
    

    // Relasi dengan jadwal
    public function schedules()
    {
        return $this->hasMany(Schedule::class, 'doctor_id');
    }

    // Anda bisa menambahkan relasi lain jika diperlukan
}
