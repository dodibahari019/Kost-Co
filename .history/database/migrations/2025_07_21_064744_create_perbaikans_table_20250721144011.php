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
        Schema::create('Perbaikan', function (Blueprint $table) {
            $table->string('id_perbaikan', 10)->primary();
            $table->string('id_penghuni', 10)->nullable();
            $table->foreign('id_penghuni')->references('id_user')->on('DataUsers');
            $table->string('id_pengurus', 10)->nullable();
            $table->foreign('id_pengurus')->references('id_user')->on('DataUsers');
            $table->string('nomor_kamar', 5)->unique();
            $table->string('ukuran', 20);
            $table->string('tipe', 15);
            $table->decimal('harga_sewa', 15, 2);
            $table->enum('status_kamar', ['Tersedia', 'Terisi', 'Dipesan']);
            $table->date('tanggal_mulai_sewa')->nullable();
            $table->date('tanggal_selesai_sewa')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Perbaikan');
    }
};
