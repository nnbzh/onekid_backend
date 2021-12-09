<?php

namespace App\Http\Resources;


class CenterResource extends AbstractResource
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
