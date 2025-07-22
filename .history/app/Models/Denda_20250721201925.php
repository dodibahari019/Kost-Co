<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Denda extends Model
{
    protected $table = 'denda';
    protected $primaryKey = 'id_denda';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_denda',
        'id_pembayaran',
        'tanggal_jatuh_tempo',
        'jumlah_denda',
        'status_denda',
    ];

    public function Pembayaran()
    {
        return $this->belongsTo(Penghuni::class, 'id_user', 'id_user');
    }
}
