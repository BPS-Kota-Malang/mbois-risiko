<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dampak extends Model
{
    use HasFactory;
    protected $table = 'dampak';

    protected $fillable = ['dampak', 'status']; // Tambahkan kolom status

    protected $attributes = [
        'status' => null,
    ];
}
