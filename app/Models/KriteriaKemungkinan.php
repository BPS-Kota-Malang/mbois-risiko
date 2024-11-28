<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KriteriaKemungkinan extends Model
{
    use HasFactory;

    protected $table = 'kriteria_kemungkinan';

    protected $fillable = [
        'id_kategori_resiko',
        'id_level_kemungkinan',
        'presentase_kemungkinan',
        'jumlah_frekuensi',
    ];

    public function kategoriResiko()
    {
        return $this->belongsTo(KategoriResiko::class, 'id_kategori_resiko');
    }

    public function levelKemungkinan()
    {
        return $this->belongsTo(LevelKemungkinan::class, 'id_level_kemungkinan');
    }
}
