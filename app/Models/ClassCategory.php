<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;

class ClassCategory extends TimestampedModel
{

    protected $fillable = [
        'name',
        'slug'
    ];

    public function classTemplates(): HasMany
    {
        return $this->hasMany(ClassTemplate::class, 'category_id', 'id');
    }
}