<?php

namespace App\Http\Resources;
use App\Http\Resources\EvenResource;
use App\Models\SessionRegistration;
use Illuminate\Support\Facades\DB;
use App\Models\Event;
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
   
        $a = SessionRegistration::where('registration_id', $this->id)->get('id');
        return [
            'event'=>EvenResource::collection(Event::where('id', $this->ticket_id)->get()),
           
            'session_id'=>$session,
        
        ];

    }
}
