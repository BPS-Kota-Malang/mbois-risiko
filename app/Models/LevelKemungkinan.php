<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LevelKemungkinan extends Model
{
    use HasFactory;

    protected $table = 'level_kemungkinan';

    protected $fillable = [
        'level_kemungkinan',
    ];

    public $timestamps = true;

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function kriteriaKemungkinan()
    {
        return $this->hasMany(KriteriaKemungkinan::class, 'id_level_kemungkinan');
    }
    public function matriksAnalisisResiko()
    {
        return $this->hasMany(MatriksAnalisisResiko::class, 'id_level_kemungkinan');
    }
}
