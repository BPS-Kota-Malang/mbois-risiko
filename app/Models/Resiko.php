<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resiko extends Model
{
    use HasFactory;
    protected $table = 'resiko';

    protected $fillable = ['resiko', 'status']; // Tambahkan kolom status

    protected $attributes = [
        'status' => null,
    ];
}
