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
        Schema::table('pindahkamar', function (Blueprint $table) {
            $table->string('nomor_kamar_tujuan')->nullable()->after('id_kamar');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pindahkamar', function (Blueprint $table) {
            //
        });
    }
};
