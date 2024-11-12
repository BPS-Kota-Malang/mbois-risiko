<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;
use App\Models\TimProject;

class Pegawai extends Model
{
    // Specify the table used by this model (optional if table name does not follow convention)
    protected $table = 'data_pegawai';

    // Specify the attributes that are mass assignable
    protected $fillable = [
        'name',
        'user_id',
        'jabatan',
        'pangkat',
        'golongan',
        'forengid', // Changed from 'tim' to 'forengid'
        'no_hp',
        'nip',
    ];

    // Specify the attributes that should be cast to specific data types
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Define the relationship to the User model
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function timProject() : BelongsTo
    {
        return $this->belongsTo(TimProject::class, 'id_tim');
    }
}
