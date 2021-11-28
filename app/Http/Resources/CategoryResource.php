<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    public function toArray($request)
    {
        $resource = [
            'id'        => $this->id,
            'name'      => $this->name,
            'img_src'   => $this->img_url
        ];

        if ($this->templates_count) {
            $resource['templates_count'] = $this->templates_count;
        }

        return $resource;
    }
}