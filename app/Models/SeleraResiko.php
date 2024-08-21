<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeleraResiko extends Model
{
    use HasFactory;

    // Nama tabel yang terkait dengan model ini
    protected $table = 'selera_resiko';

    // Primary Key
    protected $primaryKey = 'id';

    // Jika primary key tidak auto-incrementing
    public $incrementing = false;

    // Tipe data primary key
    protected $keyType = 'bigint';

    // Mengizinkan atribut untuk diisi secara massal
    protected $fillable = [
        'id_kategori_resiko',
        'resiko_minimum_negatif',
        'resiko_minimum_positif',
    ];

    // Menentukan apakah timestamps (created_at, updated_at) digunakan
    public $timestamps = false;

    // Jika diperlukan, tambahkan relasi ke model lain
    // public function kategoriResiko()
    // {
    //     return $this->belongsTo(KategoriResiko::class, 'id_kategori_resiko');
    // }
}
