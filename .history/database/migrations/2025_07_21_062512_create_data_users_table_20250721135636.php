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
            $table->string('Id_TipeUser', 10);
            $table->foreign('Id_TipeUser')->references('Id_TipeUser')->on('TipeUser');
            $table->string('Id_Jabatan', 10);
            $table->foreign('Id_Jabatan')->references('Id_Jabatan')->on('JenisJabatan');
            $table->string('Username')->unique()->nullable();
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
