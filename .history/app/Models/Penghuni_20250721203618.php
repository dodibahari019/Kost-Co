<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penghuni extends Model
{
    protected $table = 'penghuni';
    protected $primaryKey = 'id_user';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_user',
        'status_penghuni',
    ];

    public function Users()
    {
        return $this->belongsTo(DataUsers::class, 'id_user', 'id_user');
    }

    public function Kamar()
    {
        return $this->hasMany(Kamar::class, 'id_kamar', 'id_kamar');
    }

    public function Pembayaran()
    {
        return $this->hasMany(Pembayaran::class, 'id_pembayaran', 'id_pembayaran');
    }

    public function Perbaikan()
    {
        return $this->hasMany(Perbaikan::class, 'id_perbaikan', 'id_perbaikan');
    }

    public function PindahKamar()
    {
        return $this->hasMany(PindahKamar::class, 'id_pindah', 'id_pindah');
    }

    public function CheckOutKamar()
    {
        return $this->hasMany(CheckOut::class, 'id_checkout', 'id_checkout');
    }
}
