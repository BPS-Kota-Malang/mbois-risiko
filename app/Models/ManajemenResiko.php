<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManajemenResiko extends Model
{
    use HasFactory;

    protected $table = 'manajemen_resiko';

    protected $fillable = [
        'id_tim_project',
        'id_resiko',
        'id_jenis_resiko',
        'id_proses_bisnis',
        'id_sumber_resiko',
        'id_kategori_resiko',
        'id_area_dampak',
        'id_penyebab',
        'id_dampak',
        'id_level_kemungkinan',
        'id_level_resiko',
        'id_level_dampak',
        'uraian',
        'efektivitas',
    ];

    protected $casts = [
        'id_penyebab' => 'array',
        'id_dampak' => 'array',
        'uraian' => 'array',
    ];

    public function tim_project()
    {
        return $this->belongsTo(TimProject::class, 'id_tim_project');
    }

    public function resiko()
    {
        return $this->belongsTo(Resiko::class, 'id_resiko');
    }


    public function prosesBisnis()
    {
        return $this->belongsTo(ProsesBisnis::class, 'id_proses_bisnis');
    }

    public function jenisResiko()
    {
        return $this->belongsTo(JenisResiko::class, 'id_jenis_resiko');
    }

    public function sumberResiko()
    {
        return $this->belongsTo(SumberResiko::class, 'id_sumber_resiko');
    }

    public function kategoriResiko()
    {
        return $this->belongsTo(KategoriResiko::class, 'id_kategori_resiko');
    }

    public function areaDampak()
    {
        return $this->belongsTo(AreaDampak::class, 'id_area_dampak');
    }

    public function penyebab()
    {
        return $this->belongsTo(Penyebab::class, 'id_penyebab');
    }

    public function dampak()
    {
        return $this->belongsTo(Dampak::class, 'id_dampak');
    }

    public function levelKemungkinan()
    {
        return $this->belongsTo(LevelKemungkinan::class, 'id_level_kemungkinan');
    }

    public function levelResiko()
    {
        return $this->belongsTo(LevelResiko::class, 'id_level_resiko');
    }

    public function levelDampak()
    {
        return $this->belongsTo(LevelDampak::class, 'id_level_dampak');
    }
    }
