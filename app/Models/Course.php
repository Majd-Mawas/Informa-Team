<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function services()
    {
        return $this->belongsToMany(service::class, "services_courses","service_id","course_id");

        // return $this->hasMany(service::class, "Course_id");
    }
    public function category()
    {
        return $this->belongsTo(Category::class, "categories_id");
    }
}
