<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SessionRegistration extends Model
{
    use HasFactory;
    public $timestamps = false;
    public function getSes()
    {
        return $this->hasMany(Session::class, 'id', 'session_id');

        # code...
    }
    protected $fillable = [
        'registration_id',
        'session_id',
    ];
}
