<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeleraResiko extends Model
{
    use HasFactory;

    // Nama tabel yang terkait dengan model ini
    protected $table = 'selera_resiko';


    // Mengizinkan atribut untuk diisi secara massal
    protected $fillable = [
        'id_kategori_resiko',
        'resiko_minimum_negatif',
        'resiko_minimum_positif',
    ];

    public function kategoriResiko()
    {
        return $this->belongsTo(KategoriResiko::class, 'id_kategori_resiko');
    }
}
