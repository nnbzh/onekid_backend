<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AvatarPackResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'            => $this->id,
            'description'   => $this->description,
            'url'           => $this->url
        ];
    }
}
