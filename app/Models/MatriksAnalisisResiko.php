<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatriksAnalisisResiko extends Model
{
    use HasFactory;

    // Jika nama tabel tidak mengikuti konvensi Laravel, tentukan secara eksplisit
    protected $table = 'matriks_analisis_resiko';

    // Daftar atribut yang diizinkan untuk mass assignment
    protected $fillable = [
        'id_level_kemungkinan',
        'id_level_dampak',
        'besaran_resiko',
        'hasil_level_resiko',
    ];

    // Relasi ke model LevelKemungkinan
    public function levelKemungkinan()
    {
        return $this->belongsTo(LevelKemungkinan::class, 'id_level_kemungkinan');
    }

    // Relasi ke model LevelDampak
    public function levelDampak()
    {
        return $this->belongsTo(LevelDampak::class, 'id_level_dampak');
    }
}
