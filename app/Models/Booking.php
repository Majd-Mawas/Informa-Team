<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, "user_id");
    }

    public function workshop()
    {
        return $this->belongsTo(Workshop::class, "workshop_id");
    }
    public function services()
    {
        return $this->belongsTo(Service::class, "service_id");
    }
    // public function time()
    // {
    //     return $this->belongsTo(Time::class, "time_id");
    // }
}
