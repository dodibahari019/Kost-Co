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
        Schema::create('Denda', function (Blueprint $table) {
            $table->string('id_denda', 10)->primary();
            $table->string('id_pembayaran', 10)->nullable();
            $table->foreign('id_pembayaran')->references('id_pembayaran')->on('Pembayaran');
            $table->date('tanggal_jatuh_tempo');
            $table->decimal('jumlah_denda', 15, 2);
            $table->string('periode');
            $table->enum('status_pembayaran', ['Diajukan', 'Diproses', 'Selesai']);
            $table->enum('tipe_pembayaran', ['Sewa', 'Denda']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Denda');
    }
};
