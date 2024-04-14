<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $table = 'training';

    public function trainees()
    {
        return $this->hasMany(User::class, "training_id", "id");
    }
}
