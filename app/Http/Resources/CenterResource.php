<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CenterResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'lat'  => $this->lat,
            'lng'  => $this->lng,
            'code' => $this->code,
        ];
    }
}
