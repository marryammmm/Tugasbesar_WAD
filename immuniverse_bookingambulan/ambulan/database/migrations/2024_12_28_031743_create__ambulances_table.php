<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAmbulancesTable extends Migration
{
    public function up()
    {
        Schema::create('ambulances', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nama ambulans
            $table->string('photo'); // Foto ambulans
            $table->integer('distance_in_minutes'); // Jarak dalam menit
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ambulances');
    }
};

