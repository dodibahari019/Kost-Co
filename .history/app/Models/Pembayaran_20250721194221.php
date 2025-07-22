<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $table = 'pembayaran';
    protected $primaryKey = 'id_checkOut';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_pembayaran',
        'id_penghuni',
        'id_pengurus',
        'tanggal_pembayaran',
        'nominal',
        'periode',
        'status_pembayaran',
        'tipe_pembayaran',
    ];

}
