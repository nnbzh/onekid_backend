<?php

namespace App\Http\Resources;

use App\Helpers\Gender;

class UserResource extends AbstractResource
{
    public function toArray($request)
    {
        return [
            'id'            => $this->id,
            'phone'         => $this->phone,
            'is_parent'     => $this->isParent(),
            'first_name'    => $this->first_name,
            'last_name'     => $this->last_name,
            'email'         => $this->email,
            'gender'        => Gender::getRuName($this->gender),
            'username'      => $this->username,
            'avatar_url'    => $this->avatar_url,
            'birth_date'    => $this->birth_date                                                                        ,
            'is_registered' => ! empty($this->first_name) && ! empty($this->last_name),
            'parent_id'     => $this->when(! $this->isParent(), $this->parent_id),
        ];
    }
}
