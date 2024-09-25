<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimProject extends Model
{
    use HasFactory;

    protected $table = 'tim_project';

    protected $fillable = [
        'nama_team',
        'deskripsi',
    ];

    public $timestamps = true;
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function manajemen_resiko()
    {
        return $this->hasMany(ManajemenResiko::class, 'id_tim_project');
    }

}
