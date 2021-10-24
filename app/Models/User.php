<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;
use App\Models\Traits\UsesUuidTrait;
use Cviebrock\EloquentSluggable\Sluggable;

class User extends Authenticatable implements  MustVerifyEmail, JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable, UsesUuidTrait, Sluggable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'slug',
        'email_verified_at'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getJWTIdentifier() {
        return $this->getKey();
    }

    public function getJWTCustomClaims(): array
    {
        return [];
    }

    public function twittes() {
        return $this->hasMany(Twitte::class);
    }

    public function likes()
    {
        return $this->hasMany(TwitteLike::class);
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

}
