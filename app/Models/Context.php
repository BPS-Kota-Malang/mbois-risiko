<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Context extends Model
{
    protected $table = 'pemangku_kepentingan';
    protected $fillable = [
        'name',
        'kelompok',
        'hubungan'
    ];
    public $timestamps = true;
}
