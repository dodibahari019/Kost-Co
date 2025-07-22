<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataUsers extends Model
{
    protected $table = 'datausers';
    protected $primaryKey = 'id_user';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_user',
        'nama',
        'no_ktp',
        'no_hp',
        'alamat',
        'email',
        'password',
        'tipe_user',
    ];

    public function CheckOutUsers()
    {
        return $this->hasMany(CheckOut::class, 'id_checkOut', 'id_checkOut');
    }

    public function PenghuniUsers()
    {
        return $this->hasMany(Penghuni::class, 'id_user', 'id_user');
    }

    public function PengurusUsers()
    {
        return $this->hasMany(Pengurus::class, 'id_user', 'id_user');
    }
    
    public function KamarUsers()
    {
        return $this->hasMany(Kamar::class, 'id_kamar', 'id_kamar');
    }

    public function PembayaranUsers()
    {
        return $this->hasMany(Pembayaran::class, 'id_pembayaran', 'id_pembayaran');
    }


    public function PerbaikanUsers()
    {
        return $this->hasMany(Perbaikan::class, 'id_perbaikan', 'id_perbaikan');
    }

    public function PindahKamarUsers()
    {
        return $this->hasMany(PindahKamar::class, 'id_pindah', 'id_pindah');
    }
}
