<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function volunteers()
    {
        return $this->belongsToMany(User::class, "volunteers_shifts", "Shift_id", "Volunteer_id");
    }
    public function coach()
    {
        return $this->belongsToMany(User::class, "volunteers_shifts", "Shift_id", "Coach_id");
    }

    public function time()
    {
        return $this->hasMany(Time::class, 'shift_id');
    }
}
