<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisResiko extends Model
{
    use HasFactory;
    protected $table = 'jenis_resiko';

    protected $fillable = [
        'kode',
        'jenis_resiko',
    ];

    public $timestamps = true;

    protected $dates = [
        'created_at',
        'updated_at',
    ];
    
    public function opsiPenanganan()
    {
        return $this->hasMany(opsiPenanganan::class, 'id_jenis_resiko');
    }
}
