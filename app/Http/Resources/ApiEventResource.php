<?php

namespace App\Http\Resources;
use App\Http\Resources\EventTicketResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\EventTicket;
class ApiEventResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [

            'event_ticket'=>EventTicketResource::collection(EventTicket::where('id', $request->ticket_id)->get()),
        ];
    }
}
