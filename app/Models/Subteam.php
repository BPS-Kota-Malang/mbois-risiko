<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subteam extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'tim_project_id',
        'description',
    ];


    public function timProject()
    {
        return $this->belongsTo(TimProject::class);
    }

    public function activity()
    {
        return $this->hasMany(Activity::class);
    }

}
