<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengurus extends Model
{
    protected $table = 'pengurus';
    protected $primaryKey = 'id_user';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_user',
        'jadwal_kerja',
    ];

    public function UsersPengurus()
    {
        return $this->belongsTo(DataUsers::class, 'id_user', 'id_user');
    }

    public function KamarPengurus()
    {
        return $this->hasMany(Kamar::class, 'id_kamar', 'id_kamar');
    }

    public function PembayaranPengurus()
    {
        return $this->hasMany(Pembayaran::class, 'id_pembayaran', 'id_pembayaran');
    }

    public function PerbaikanPengurus()
    {
        return $this->hasMany(Perbaikan::class, 'id_perbaikan', 'id_perbaikan');
    }

    public function PindahKamarPengurus()
    {
        return $this->hasMany(PindahKamar::class, 'id_pindah', 'id_pindah');
    }

    public function CheckOutKamarPengurus()
    {
        return $this->hasMany(CheckOut::class, 'id_checkout', 'id_checkout');
    }
}
