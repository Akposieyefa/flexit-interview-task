<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Twitte extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = [
        'title', 'slug', 'user_id', 'message'
    ];

    public function likes()
    {
        return $this->hasMany(TwitteLike::class);
    }

    public function comments() {
        return $this->hasMany(TwitteComment::class);
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
