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

    public function Penghuni()
    {
        return $this->belongsTo(DataUsers::class, 'Id_DataUser', 'Id_DataUser');
    }

    public function DataMobilInputPenjualanMobil()
    {
        return $this->belongsTo(Mobil::class, 'Id_Mobil', 'Id_Mobil');
    }
}
