<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workshop extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function coach()
    {
        return $this->belongsToMany(User::class, "training", "Workshop_id", "coach_id");
    }
    public function booking()
    {
        return $this->hasMany(Booking::class, "Workshop_id");
    }
}
