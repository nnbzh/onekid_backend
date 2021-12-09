<?php

namespace App\Models;

use App\Traits\Reviewable;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Center extends TimestampedModel
{
    use HasFactory, CrudTrait, Reviewable;

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

    public function getQrCodeAttribute() {
        return route('centers.qr-code', ['code' => $this->attributes['code']]);
    }
}
