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

    public function PengurusUsers()
    {
        return $this->belongsTo(DataUsers::class, 'id_user', 'id_user');
    }

    public function PengurusKamar()
    {
        return $this->hasMany(Kamar::class, 'id_kamar', 'id_kamar');
    }

    public function PengurusPembayaran()
    {
        return $this->hasMany(Pembayaran::class, 'id_pembayaran', 'id_pembayaran');
    }

    public function PengurusPerbaikan()
    {
        return $this->hasMany(Perbaikan::class, 'id_perbaikan', 'id_perbaikan');
    }

    public function PengurusPindahKamar()
    {
        return $this->hasMany(PindahKamar::class, 'id_pindah', 'id_pindah');
    }

    public function PengurusCheckOutKamar()
    {
        return $this->hasMany(CheckOut::class, 'id_checkout', 'id_checkout');
    }
}
