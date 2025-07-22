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
        Schema::create('Penghuni', function (Blueprint $table) {
            $table->string('id_user', 10)->primary();
            $table->foreign('id_user')->references('id_user')->on('DataUsers');
            $table->string('nama', 50);
            $table->enum('status_penghuni', ['Aktif', 'Pengurus']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Penghuni');
    }
};
