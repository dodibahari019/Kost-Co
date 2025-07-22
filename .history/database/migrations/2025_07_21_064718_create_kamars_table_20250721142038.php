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
        Schema::create('Kamar', function (Blueprint $table) {
            $table->string('id_kamar', 10)->primary();
            $table->string('id_penghuni', 10)->primary();
            $table->foreign('id_penghuni')->references('id_user')->on('DataUsers');
            $table->string('nomor_kamar', 5)->unique();
            $table->string('ukuran', 20);
            $table->string('tipe', 15);
            $table->decimal('harga_sewa', 15.2);
            $table->string('email', 50)->unique();
            $table->string('password');
            $table->enum('tipe_user', ['Penghuni', 'Pengurus']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Kamar');
    }
};
