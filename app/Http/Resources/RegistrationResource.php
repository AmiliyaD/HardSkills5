<?php

namespace App\Http\Resources;
use App\Http\Resources\EvenResource;
use App\Models\SessionRegistration;
use Illuminate\Support\Facades\DB;
use App\Models\Event;
use App\Models\EventTicket;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use App\Models\SessionRegistration as ModelsSessionRegistration;
use Illuminate\Http\Resources\Json\JsonResource;

class RegistrationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
      
        $session = SessionRegistration::where('registration_id', $this->id)->get('id')->modelKeys();
        $sessionInfo = SessionRegistration::where('registration_id', $this->id)->get();
        $a = SessionRegistration::where('registration_id', $this->id)->get('id');
        return [
            'event'=>EvenResource::collection(Event::where('id', $this->ticket_id)->get()),
            // 'event2'=>Event::find('id', $this->event)->get(),  
            'id'=>$this->id, 
            'tickets'=>DB::table('event_tickets')->where('id', $this->ticket_id)->get(),
            'ev'=>DB::table('events')->join('event_tickets', function ($join) {
                $join->on('events.id', '=', 'event_tickets.event_id')
                     ->where('event_tickets.id', '=', $this->ticket_id);
            })->first(),
            // 'tick'=>EventTicket::find('id')->->get(),  
            'session'=>$sessionInfo, 
            'session_id'=>$session,
        ];

    }
}
