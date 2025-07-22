<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CheckOut extends Model
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

    public function PenghuniCheckOut()
    {
        return $this->belongsTo(Penghuni::class, 'id_user', 'id_user');
    }

    public function Pengurus()
    {
        return $this->belongsTo(Pengurus::class, 'id_user', 'id_user');
    }
}
