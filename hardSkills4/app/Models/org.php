<?php

namespace App\Models;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Illuminate\Database\Eloquent\Model;

class org extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = 'organizers';
    protected $fillable = [
        'name',
        'email',
        'password_hash',
    ];
    protected $hidden = [
        'password_hash',
     
    ];
}
