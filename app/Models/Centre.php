<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Centre extends TimestampedModel
{
    use HasFactory;

    protected $fillable = [
        'name',
        'business_id'
    ];
}