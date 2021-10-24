<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountVerificationToken extends Model
{
    use HasFactory;

    protected $fillable = [
        'email', 'token'
    ];
}
