<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EventTicketResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $sp = '';
        if($this->special_validity == 'amount') {
            $sp = $this->max_sold;
        }
        else if($this->special_validity == 'date') {
            $sp = $this->date_until;
        }
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'event_id'=>$this->event_id,
            'cost'=>$this->cost,
            'special_validity'=>$this->special_validity,
            'description'=>$sp
           
        ];
    }
}
