<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TwitteComment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'twitte_id', 'comment'
    ];

    public function commentor()  {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function twitte() {
        return $this->belongsTo(Twitte::class, 'twitte_id');
    }
}
