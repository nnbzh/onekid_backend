<?php

namespace App\Repositories;

use App\Models\AvatarPack;

class AvatarPackRepository
{
    public function create($attributes) {
        return AvatarPack::query()->create($attributes);
    }
}
