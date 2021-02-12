<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\SessionResource;
use App\Models\Session;
class RoomResource extends JsonResource
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
            'channel_id'=>$this->channel_id,
            'name'=>$this->name,
            'session'=>SessionResource::collection(Session::where('room_id', $this->id)->get())
        ];
    }
}
