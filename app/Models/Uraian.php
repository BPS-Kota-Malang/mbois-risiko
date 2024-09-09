<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Uraian extends Model
{
    use HasFactory;
    protected $table = 'uraian';

    protected $fillable = ['uraian', 'status']; // Tambahkan kolom status

    protected $attributes = [
        'status' => null,
    ];
}
