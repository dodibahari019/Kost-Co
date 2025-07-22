<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $table = 'pembayaran';
    protected $primaryKey = 'id_pembayaran';
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

    public function DendaPembayaran()
    {
        return $this->hasMany(CheckOut::class, 'id_checkOut', 'id_checkOut');
    }

    public function PenghuniPembayaran()
    {
        return $this->belongsTo(Penghuni::class, 'id_user', 'id_user');
    }

    public function PengurusPembayaran()
    {
        return $this->belongsTo(Pengurus::class, 'id_user', 'id_user');
    }
}
