<?php

namespace App\Http\Resources;


class AvatarPackResource extends AbstractResource
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
