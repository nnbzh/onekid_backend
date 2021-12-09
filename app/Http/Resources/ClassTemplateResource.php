<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ClassTemplateResource extends JsonResource
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
