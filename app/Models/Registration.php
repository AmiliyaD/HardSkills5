<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;
    public function eventTick()
    {
        return $this->belongsTo(EventTicket::class, 'ticket_id');
        # code...
    }
    public function event()
    {
        return $this->hasOneThrough(Event::class, EventTicket::class, 'event_id', 'id', 'id', 'id');
        # code...
    }
    public function sessions()
    {
        return $this->hasMany(SessionRegistration::class, 'registration_id', 'id');
        # code...
    }
    public $timestamps = false;
}
