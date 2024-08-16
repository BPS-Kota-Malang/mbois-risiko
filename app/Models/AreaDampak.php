<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AreaDampak extends Model
{
    use HasFactory;

    protected $table = 'area_dampak';

    protected $fillable = [
        'area_dampak',
    ];

    public $timestamps = true;

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function kriteriaDampak()
    {
        return $this->hasMany(KriteriaDampak::class, 'id_area_dampak');
    }
}
