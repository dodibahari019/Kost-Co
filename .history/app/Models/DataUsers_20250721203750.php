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

    public function UsersPenghuni()
    {
        return $this->hasMany(Penghuni::class, 'id_user', 'id_user');
    }

    public function PengurusUsers()
    {
        return $this->hasMany(Pengurus::class, 'id_user', 'id_user');
    }
}
