<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    
    public $timestamps = false;
    public function organizers() {
        return $this->belongsTo(Organizer::class);
    }
    public function registrations()
    {
        
            return $this->hasManyThrough(Registration::class, EventTicket::class,
            'event_id',
             'ticket_id',
             'id',
             'id'   
    );
    }
    //ВМЕСТИМОСТЬ КОМНАТЫ ДЛЯ ДИАГРАММЫ
    public function getRoom() {
        return $this->hasManyThrough(Room::class, Channel::class, 'event_id', 'channel_id');
    }
    public function getSes(){
        return $this->hasManyThrough(Session::class, Room::class, 'room_id', 'channel_id' );
    }
    // КАНАЛЫ
    public function chanells()
    {
        return $this->hasMany(Channel::class);
     
    }
}
