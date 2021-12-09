<?php

namespace App\Http\Resources;


class CategoryResource extends AbstractResource
{
    public function toArray($request)
    {
        $resource = [
            'id'        => $this->id,
            'name'      => $this->name,
            'img_src'   => $this->img_url,
            'templates_count' => $this->templates_count
        ];

        return $resource;
    }
}
