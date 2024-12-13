<?php

// app/Models/Activity.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'subteam_id'];

    public function subteam()
    {
        return $this->belongsTo(Subteam::class);
    }
}
