<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\OrganizerResource;
use App\Http\Resources\ChannelResource;
use App\Http\Resources\EventTicketResource;
use App\Models\Channel;
use App\Models\Organizer;
use App\Models\EventTicket;
use Mockery\Undefined;

class EventResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // if (Organizer::where('id', $this->organizer_id)->get() == null || empty(Organizer::where('id', $this->organizer_id)->get())) {
        //     return [
        //         'data'=>'not found'
        //     ];
        // };

    //    if (is_null(Organizer::find('id', $this->organizer_id))) {
    //        return response()->json(['message'=>'not'], 404);
    //    };
        
            return [
                'event'=>[
                    'id'=>$this->id,
                    'name'=>$this->name,
                    'slug'=>$this->slug,
                    'date'=>$this->date,
                    'event_ticket'=>EventTicketResource::collection(EventTicket::where('event_id', $this->id)->get()),
                    'channels'=>ChannelResource::collection(Channel::where('event_id', $this->id)->get()),
                    // 'organizer'=>OrganizerResource::collection(Organizer::where('id', $this->organizer_id)->get()),        
                    
                ]
                ];
        
        
            
    }
}
