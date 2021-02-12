<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\RoomResource;
use App\Models\Room;
class ChannelResource extends JsonResource
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
            'name'=>$this->name,
            'event_id'=>$this->event_id,
            'room'=>RoomResource::collection(Room::where('channel_id', $this->id)->get())
        ];
    }
}
