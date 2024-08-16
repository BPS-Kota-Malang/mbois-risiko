<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SumberResiko extends Model
{
    protected $table = 'sumber_resiko';
    protected $fillable = [
        'kode',
        'sumber_resiko',
    ];
    protected $guarded = [];
    public $timestamps = true;
    protected $dates = [
        'created_at',
        'updated_at',
    ];
}
