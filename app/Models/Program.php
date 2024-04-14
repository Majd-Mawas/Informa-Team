<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function services()
    {
        return $this->hasMany(service::class, "Program_id", "id");
    }

    public function category()
    {
        return $this->belongsTo(Category::class, "categories_id", "id");
    }
}
