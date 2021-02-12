<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory;
    
    public $timestamps = false;
    public function evId()
    {
        return $this->belongsTo(Room::class, 'room_id', 'id');
     
    }

    // public function roomMany()
    // {
    //     return $this->belongsToMany(Room::class, 'room_id', 'id');
     
    // }
    public function sessionReg()
    {
        return $this->hasMany(SessionRegistration::class, 'session_id', 'id');
        # code...
    }
}
