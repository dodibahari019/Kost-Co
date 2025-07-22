<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Perbaikan extends Model
{
    protected $table = 'perbaikan';
    protected $primaryKey = 'id_perbaikan';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_perbaikan',
        'id_penghuni',
        'id_pengurus',
        'tanggal_ajuan',
        'status_perbaikan',
        'catatan',
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
