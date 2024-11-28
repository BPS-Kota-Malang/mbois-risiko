<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriResiko extends Model
{
    use HasFactory;

    protected $table = 'kategori_resiko';

    protected $fillable = [
        'deskripsi',
        'definisi',
    ];

    public $timestamps = true;

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function kriteriaKemungkinan()
    {
        return $this->hasMany(KriteriaKemungkinan::class, 'id_kategori_resiko');
    }

    public function seleraResiko()
    {
        return $this->hasMany(SeleraResiko::class, 'id_kategori_resiko');
    }
}

