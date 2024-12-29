<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ambulance;

class AmbulanceSeeder extends Seeder
{
    public function run()
    {
        // Ambulans RSAI Bandung
        Ambulance::create([
            'name' => 'Ambulans RSAI Bandung',
            'photo' => 'images/ambulan1.png', // Ganti ke path lokal
            'distance_in_minutes' => 5, // Waktu tempuh dalam menit
            'distance_in_meters' => 300, // Tambahkan kolom jarak dalam meter
        ]);

        // Ambulans RSUD Kota Bandung
        Ambulance::create([
            'name' => 'Ambulans Mayapada',
            'photo' => 'images/ambulan2.png', // Ganti ke path lokal
            'distance_in_minutes' => 8, // Waktu tempuh dalam menit
            'distance_in_meters' => 400, // Tambahkan kolom jarak dalam meter
        ]);
    }
}
