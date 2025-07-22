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

    public function CheckOut()
    {
        return $this->hasMany(CheckOut::class, 'id_checkOut', 'id_checkOut');
    }
}
