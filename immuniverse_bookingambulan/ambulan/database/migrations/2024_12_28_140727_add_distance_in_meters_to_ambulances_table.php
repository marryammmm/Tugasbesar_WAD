<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('ambulances', function (Blueprint $table) {
            $table->integer('distance_in_meters')->nullable(); // Menambahkan kolom baru
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ambulances', function (Blueprint $table) {
            $table->dropColumn('distance_in_meters'); // Menghapus kolom jika migrasi di-rollback
        });
    }
};
