<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('doctors')->insert([
            [
                'name' => 'Dr. John Doe',
                'specialization' => 'Cardiology',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dr. Jane Smith',
                'specialization' => 'Neurology',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dr. Mike Johnson',
                'specialization' => 'Orthopedics',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dr. Emily Davis',
                'specialization' => 'Pediatrics',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dr. Sarah Wilson',
                'specialization' => 'Dermatology',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

