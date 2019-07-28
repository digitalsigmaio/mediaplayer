<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TrackResource extends JsonResource
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
            'id' => $this->id,
            'title' => $this->title,
            'url' => $this->audio,
            'ringtone' => $this->ringtone,
            'vodafone' => $this->vodafone,
            'orange' => $this->orange,
            'etisalat' => $this->etisalat
        ];
    }

    public function with( $request )
    {
        return [
            'album' => $this->album
        ];
    }
}
