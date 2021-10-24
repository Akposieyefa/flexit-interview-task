<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TwitteLike extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','twitte_id'];

    public function liker()  {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function twitte() {
        return $this->belongsTo(Twitte::class, 'twitte_id');
    }
}
