<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $table = 'checkout';
    protected $primaryKey = 'id_checkOut';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_checkOut',
        'id_penghuni',
        'id_pengurus',
        'tanggal_ajuan',
        'status_checkout',
        'catatan',
    ];
}
