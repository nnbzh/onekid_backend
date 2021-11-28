<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Business extends TimestampedModel
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;

    protected $table = 'businesses';

    protected $fillable = [
        'name'
    ];
}