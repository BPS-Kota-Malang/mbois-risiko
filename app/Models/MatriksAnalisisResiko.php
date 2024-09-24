<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatriksAnalisisResiko extends Model
{
    use HasFactory;
    protected $table = 'matriks_analisis_resiko';

    protected $fillable = [
        'id_level_kemungkinan',
        'id_level_dampak',
        'besaran_resiko',
        'hasil_level_resiko',
    ];
    public function levelKemungkinan()
    {
        return $this->belongsTo(LevelKemungkinan::class, 'id_level_kemungkinan');
    }

    public function levelDampak()
    {
        return $this->belongsTo(LevelDampak::class, 'id_level_dampak');
    }
}