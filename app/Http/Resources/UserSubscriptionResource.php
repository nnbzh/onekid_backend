<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserSubscriptionResource extends AbstractResource
{
    public function toArray($request)
    {
        return [
            'id'            => $this->id,
            'expires_at'    => $this->expires_at,
            'visits_remain' => $this->visits_remain,
            'subscription'  => new SubscriptionResource($this->subscription)
        ];
    }
}
