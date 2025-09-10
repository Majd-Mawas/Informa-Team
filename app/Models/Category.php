<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'path'];

    public function courses()
    {
        return $this->hasMany(Course::class, "categories_id");
    }

    public function programs()
    {
        return $this->hasMany(Program::class, "categories_id");
    }

    public function products()
    {
        return $this->hasMany(Product::class, "category_id");
    }
}
