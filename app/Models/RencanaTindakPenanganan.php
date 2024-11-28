<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RencanaTindakPenanganan extends Model
{
    use HasFactory;

    protected $table = 'rencana_tindak_penanganan';

    protected $fillable = [
        'name',
        'target_output',
        'target_waktu',
        'id_data_pegawai',
        'id_level_kemungkinan',
        'id_level_dampak',
        'id_matriks_analisis_resiko',
        'id_manajemen_resiko',
    ];

    public function dataPegawai()
    {
        return $this->belongsTo(Pegawai::class, 'id_data_pegawai');
    }

    public function levelKemungkinan()
    {
        return $this->belongsTo(LevelKemungkinan::class, 'id_level_kemungkinan');
    }

    public function levelDampak()
    {
        return $this->belongsTo(LevelDampak::class, 'id_level_dampak');
    }

    public function matriksAnalisisResiko()
    {
        return $this->belongsTo(MatriksAnalisisResiko::class, 'id_matriks_analisis_resiko');
    }

    public function manajemenResiko()
    {
        return $this->belongsTo(ManajemenResiko::class, 'id_manajemen_resiko');
    }
}