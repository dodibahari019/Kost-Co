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
        Schema::create('DataUsers', function (Blueprint $table) {
            $table->string('id_user', 10)->primary();
            $table->string('tipe')->unique()->nullable();
            $table->string('nama');
            $table->string('no_ktp')->unique()->nullable();
            $table->string('no_hp')->unique()->nullable();
            $table->text('alamat')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('password')->nullable();
            $table->string('Foto_Profil')->nullable();
            $table->string('Foto_KTP')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('DataUsers');
    }
};
