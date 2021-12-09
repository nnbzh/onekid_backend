<?php

namespace App\Models;

class Review extends TimestampedModel
{
    protected $table = 'reviews';

    protected $fillable = [
        'reviewable_id',
        'reviewable_type',
        'rate',
        'comment'
    ];

    public function reviewable() {
        return $this->morphTo();
    }

}
