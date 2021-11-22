<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassTemplate extends TimestampedModel
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'center_id',
        'category_id'
    ];

    public function center() {
        return $this->belongsTo(Center::class, 'center_id', 'id');
    }
}