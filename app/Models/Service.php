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
        // return $this->belongsToMany(Program::class, "services_programs","service_id","program_id");
        return $this->belongsTo(Program::class, "Program_id");
    }
    public function courses()
    {
        // return $this->belongsToMany(Course::class, "services_courses","service_id","course_id");

        return $this->belongsTo(Course::class, "Course_id");
    }
    public function maintenances()
    {
        return $this->belongsTo(Maintenance::class, "Maintenance_id");
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
