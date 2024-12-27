<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('full_name')->nullable();
            $table->enum('gender', ['Male', 'Female'])->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('security_question')->nullable();
            $table->string('security_answer')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('full_name');
            $table->dropColumn('gender');
            $table->dropColumn('date_of_birth');
            $table->dropColumn('security_question');
            $table->dropColumn('security_answer');
        });
    }
}
