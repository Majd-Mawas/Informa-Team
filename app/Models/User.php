<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function training()
    {
        return $this->belongsTo(Training::class, "training_id");
    }

    public function shifts()
    {
        return $this->belongsToMany(Shift::class, "volunteers_shifts", "Volunteer_id", "Shift_id");
    }

    public function workshops()
    {
        return $this->belongsToMany(Workshop::class, "training", "coach_id", "Workshop_id");
    }

    public function vol_services()
    {
        return $this->hasMany(Service::class, "Volunteer_id", "id");
    }

    public function services()
    {
        return $this->hasMany(Service::class, "Beneficiarie_id", "id");
    }
    public function article()
    {
        return $this->hasMany(Article::class, "author_id");
    }

    public function chat()
    {
        return $this->hasMany(Chat::class, 'user_id');
    }

    public function message()
    {
        return $this->hasMany(Message::class, "user_id");
    }

    public function rating()
    {
        return $this->hasMany(Rating::class, "user_id");
    }
    public function role()
    {
        return $this->belongsTo(Role::class, "role_id");
    }
}
