<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProsesBisnis extends Model
{
    use HasFactory;

    protected $table = 'proses_bisnis';

    protected $fillable = [
        'proses_bisnis',
    ];

    public $timestamps = true;

    protected $dates = [
        'created_at',
        'updated_at',
    ];
}
