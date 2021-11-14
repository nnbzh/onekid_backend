<?php

namespace App\Models;

class UserProfile extends TimestampedModel
{
    protected $fillable = [
        'user_id',
        'type_id',
        'gender_id',
        'birth_date'
    ];
}