<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SessionResource extends JsonResource
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
            'id'=>$this->id,
            'room_id'=>$this->room_id,
            'title'=>$this->title,
            'start'=>$this->start,
            'end'=>$this->end,
            'cost'=>$this->cost
        ];
    }
}
