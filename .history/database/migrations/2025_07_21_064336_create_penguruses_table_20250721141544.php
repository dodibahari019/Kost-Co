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
        Schema::create('Pengurus', function (Blueprint $table) {
            $table->string('id_user', 10)->primary();
            $table->foreign('id_user')->references('id_user')->on('DataUsers');
            $table->string('jadwal_kerja');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Pengurus');
    }
};
