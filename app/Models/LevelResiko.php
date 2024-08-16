<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LevelResiko extends Model
{
    use HasFactory;

    protected $table = 'level_resiko';

    protected $fillable = [
        'level_resiko',
        'besaran_min',
        'besaran_max',
        'tindakan',
        'ket_warna',
    ];

    /**
     * Get the matriks analisis resiko for this level resiko.
     */
    public function matriksAnalisisResiko()
    {
        return $this->hasMany(MatriksAnalisisResiko::class, 'id_level_resiko');
    }
}
