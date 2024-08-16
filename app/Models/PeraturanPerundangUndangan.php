<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PeraturanPerundangUndangan extends Model
{
    protected $table = 'peraturan_perundang_undangan';
    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'peraturan_perundang_undangan',
        'amanat',
    ];
}
