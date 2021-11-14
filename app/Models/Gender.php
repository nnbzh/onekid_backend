<?php

namespace App\Models;

use App\Traits\HasFilters;

class Gender extends TimestampedModel
{
    use HasFilters;

    protected $fillable = [
        'slug',
        'name'
    ];

}