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

    public function PenghuniCheckOut()
    {
        return $this->belongsTo(Penghuni::class, 'id_user', 'id_user');
    }

    public function PengurusCheckOut()
    {
        return $this->belongsTo(Pengurus::class, 'id_user', 'id_user');
    }
}
