<?php

namespace App\Http\Resources;
use App\Models\Organizer;
use App\Http\Resources\OrganizerResource;
use Illuminate\Http\Resources\Json\JsonResource;

class EvenResource extends JsonResource
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
            'org'=>$this->organizer_id,
            'slug'=>$this->slug,
            'date'=>$this->date,
            'organizer'=>Organizer::where('id', $this->organizer_id)->first()
            
        ];
    }
}
