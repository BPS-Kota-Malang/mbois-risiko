<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KriteriaDampak extends Model
{
    use HasFactory;

    protected $table = 'kriteria_dampak';

    protected $fillable = [
        'id_area_dampak',
        'id_level_dampak',
        'deskripsi_negatif',
        'deskripsi_positif',
    ];

    public function areaDampak()
    {
        return $this->belongsTo(AreaDampak::class, 'id_area_dampak');
    }

    // Relasi dengan LevelDampak
    public function levelDampak()
    {
        return $this->belongsTo(LevelDampak::class, 'id_level_dampak');
    }
}
