<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PindahKamar extends Model
{
    protected $table = 'pindahkamar';
    protected $primaryKey = 'id_pindah';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_pindah',
        'id_penghuni',
        'id_pengurus',
        'tanggal_ajuan',
        'status_pindah',
        'catatan',
        'nomor_kamar_tujuan',
    ];

    public function PenghuniPindahKamar()
    {
        return $this->belongsTo(Penghuni::class, 'id_user', 'id_user');
    }

    public function PengurusPindahKamar()
    {
        return $this->belongsTo(Pengurus::class, 'id_user', 'id_user');
    }
}
