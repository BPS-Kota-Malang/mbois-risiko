<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OpsiPenanganan extends Model
{
    use HasFactory;

    // Nama tabel yang terkait dengan model ini
    protected $table = 'opsi_penanganan';
    // Mengizinkan atribut untuk diisi secara massal
    protected $fillable = [
        'opsi_penanganan',
        'deskripsi',
        'id_jenis_resiko',
    ];

    public $timestamps = true;

    protected $dates = [
    'created_at',
    'updated_at',
    ];
    public function jenisResiko()
    {
        return $this->belongsTo(jenisResiko::class, 'id_jenis_resiko');
    }
}
