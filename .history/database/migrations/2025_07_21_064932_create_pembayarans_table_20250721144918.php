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
        Schema::create('Pembayaran', function (Blueprint $table) {
            $table->string('id_pindah', 10)->primary();
            $table->string('id_penghuni', 10)->nullable();
            $table->foreign('id_penghuni')->references('id_user')->on('DataUsers');
            $table->string('id_pengurus', 10)->nullable();
            $table->foreign('id_pengurus')->references('id_user')->on('DataUsers');
            $table->date('tanggal_pembayaran');
            $table->decimal('nominal', 15, 2);
            $table->
            $table->enum('status_pindah', ['Diajukan', 'Diproses', 'Selesai']);
            $table->text('catatan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Pembayaran');
    }
};
