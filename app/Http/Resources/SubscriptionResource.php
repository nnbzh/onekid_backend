<?php

namespace App\Http\Resources;

use App\Helpers\SubscriptionType;
use Illuminate\Http\Resources\Json\JsonResource;

class SubscriptionResource extends AbstractResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'period' => $this->type == SubscriptionType::YEARLY ? 'year' : 'month',
            'price' => $this->price,
            'visits_per_week' => $this->visits_per_week
        ];
    }
}
