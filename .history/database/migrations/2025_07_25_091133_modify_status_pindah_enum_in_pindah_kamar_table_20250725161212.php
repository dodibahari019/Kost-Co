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
            DB::statement("ALTER TABLE PindahKamar MODIFY status_pindah ENUM('Diajukan', 'Ditolak', 'Disetujui') NOT NULL");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pindahkamar', function (Blueprint $table) {
            // Jika ingin rollback ke enum sebelumnya
            DB::statement("ALTER TABLE PindahKamar MODIFY status_pindah ENUM('Diajukan', 'Diproses', 'Selesai') NOT NULL");
        });
    }
};
