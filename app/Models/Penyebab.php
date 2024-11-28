<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penyebab extends Model
{
    use HasFactory;
    protected $table = 'penyebab';

    protected $fillable = ['penyebab', 'status']; // Tambahkan kolom status

    protected $attributes = [
        'status' => null,
    ];

}
