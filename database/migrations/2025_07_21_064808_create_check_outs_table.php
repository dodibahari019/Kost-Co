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
        Schema::create('CheckOut', function (Blueprint $table) {
            $table->string('id_checkOut', 10)->primary();
            $table->string('id_penghuni', 10);
            $table->foreign('id_penghuni')->references('id_user')->on('DataUsers');
            $table->string('id_pengurus', 10)->nullable();
            $table->foreign('id_pengurus')->references('id_user')->on('DataUsers');
            $table->date('tanggal_ajuan');
            $table->enum('status_checkout', ['Diajukan', 'Diproses', 'Selesai']);
            $table->text('catatan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('CheckOut');
    }
};
