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
        if (!Schema::hasTable('schedules')) {
            Schema::create('schedules', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('doctor_id');
                $table->dateTime('start_time');
                $table->dateTime('end_time');
                $table->string('day_of_week');
                $table->timestamps();
    
                $table->foreign('doctor_id')->references('id')->on('users')->onDelete('cascade');
                $table->foreign('payment_id')->references('id')->on('payment')->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
