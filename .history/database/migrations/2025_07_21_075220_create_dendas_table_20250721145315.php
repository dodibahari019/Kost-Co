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
            $table->foreign('id_pembayaran')->references('id_pembayaran')->on('DataUsers');
            $table->string('id_pengurus', 10)->nullable();
            $table->foreign('id_pengurus')->references('id_user')->on('DataUsers');
            $table->date('tanggal_pembayaran');
            $table->decimal('nominal', 15, 2);
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
