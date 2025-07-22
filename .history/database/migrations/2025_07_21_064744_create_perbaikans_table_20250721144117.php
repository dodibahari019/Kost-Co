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
            $table->date('tanggal_ajuan');
            $table->enum('status_perbaikan', ['Tersedia', 'DiPros', 'Dipesan']);
            $table->text('catatan');
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
