<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    use HasFactory;
    public $timestamps = false;
    public function Rooms()
    {
        return $this->hasMany(Room::class);
        # code...
    }
    public function Session()
    {
        return $this->hasManyThrough(Session::class, Room::class);
        # code...
    }
}
