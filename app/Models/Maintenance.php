<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function services()
    {
        return $this->hasMany(service::class, "Maintenance_id", "id");
    }
}
