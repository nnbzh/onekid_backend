<?php

namespace App\Traits;

use App\Models\Review;

trait Reviewable
{
    public function reviews() {
        return $this->morphMany(Review::class, 'reviewable');
    }
}
