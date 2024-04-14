<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function beneficiaries()
    {
        return $this->belongsTo(User::class, "Beneficiarie_id");
    }

    public function programs()
    {
        return $this->belongsTo(Program::class, "id");
    }
    public function courses()
    {
        return $this->belongsTo(Course::class, "id");
    }
    public function maintenances()
    {
        return $this->belongsTo(Maintenance::class, "id");
    }
    public function volunteers()
    {
        return $this->belongsTo(User::class, "Volunteer_id");
    }

    public function booking()
    {
        return $this->hasMany(Booking::class, "service_id");
    }
}
