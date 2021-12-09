<?php

namespace App\Http\Resources;


class ClassTemplateResource extends AbstractResource
{
    public function toArray($request) {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'img_src' => $this->img_url,
            'center'  => new CenterResource($this->whenLoaded('center'))
        ];
    }
}
