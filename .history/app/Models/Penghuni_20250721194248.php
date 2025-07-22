<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penghuni extends Model
{
    protected $table = 'penghuni';
    protected $primaryKey = 'id_kamar';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_kamar',
        'id_penghuni',
        'nomor_kamar',
        'ukuran',
        'tipe',
        'harga_sewa',
        'status_kamar',
        'tanggal_mulai_sewa',
        'tanggal_selesai_sewa',
    ];
}
