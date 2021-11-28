<?php

namespace App\Models;

use App\Traits\HasFilters;
use App\Traits\Imageable;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ClassCategory extends TimestampedModel
{
    use HasFilters, Imageable, CrudTrait;

    protected $fillable = [
        'name',
        'slug',
        'img_src'
    ];

    public function templates(): HasMany
    {
        return $this->hasMany(ClassTemplate::class, 'category_id');
    }
}