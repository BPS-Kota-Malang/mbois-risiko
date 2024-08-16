<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LevelDampak extends Model
{
    use HasFactory;

    protected $table = 'level_dampak';

    protected $fillable = [
        'level_dampak',
        'deskripsi',
    ];

    public $timestamps = true;

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function kriteriaDampak()
    {
        return $this->hasMany(KriteriaDampak::class, 'id_level_dampak');
    }
    public function matriksAnalisisResiko()
    {
        return $this->hasMany(MatriksAnalisisResiko::class, 'id_level_dampak');
    }
}
