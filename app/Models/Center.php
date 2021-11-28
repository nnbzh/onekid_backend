<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Center extends TimestampedModel
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;

    protected $fillable = [
        'name',
        'business_id',
        'code',
        'lat',
        'lng'
    ];

    public function business() {
        return $this->belongsTo(Business::class);
    }
}