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

    public function PenghuniUsers()
    {
        return $this->belongsTo(DataUsers::class, 'id_user', 'id_user');
    }
}
