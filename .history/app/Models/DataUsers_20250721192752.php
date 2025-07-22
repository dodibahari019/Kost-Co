<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataUsers extends Model
{
    protected $table = 'DataUsers';
    protected $primaryKey = 'Id_DataUser';
    public $incrementing = false; // non auto-increment
    protected $keyType = 'string'; // karena Id_Supplier berupa string

    protected $fillable = [
        'Id_DataUser',
        'Id_TipeUser',
        'Id_Jabatan',
        'Username',
        'Password',
        'Nama_Lengkap',
        'No_KTP',
        'Email',
        'No_Hp',
        'Alamat',
        'Foto_Profil',
        'Foto_KTP',
        'Google_Id',
        'Email_Verified_At',
        'No_Hp_Verified_At',
        'remember_token',
    ];
}
