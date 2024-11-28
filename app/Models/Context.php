<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Context extends Model
{
    protected $table = 'pemangku_kepentingan';
    protected $fillable = [
        'pemangku_kepentingan',
        'kelompok_pemangku_kepentingan',
        'hubungan'
    ];
    public $timestamps = true;
}
