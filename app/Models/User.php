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
    protected $fillable = [
        'assigned_id',
        'title',
        'firstname',
        'lastname',
        'role',
        'email',
        'colleges',
        'courses',
        'position',
        'phone_number',
        'profile_image',
        'password',
    ];

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
    ];


    public function protocols(){

        return $this->hasMany(Protocol::class);
    }

    public function researchers(){

        return $this->hasMany(Researcher::class);
    }

    public function meetings(){

        return $this->hasMany(Meeting::class);
    }

    public function folders(){

        return $this->hasMany(Folder::class);
    }
}