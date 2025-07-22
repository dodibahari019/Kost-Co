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
        'nama',
        'no_ktp',
        'no_hp',
        'alamat',
        'email',
        'password',
        'tipe_user',
    ];
}
