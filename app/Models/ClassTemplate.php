<?php

namespace App\Models;

use App\Traits\Imageable;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClassTemplate extends TimestampedModel
{
    use CrudTrait, HasFactory, Imageable;

    protected $fillable = [
        'name',
        'description',
        'center_id',
        'category_id',
        'img_src'
    ];

    public function center() {
        return $this->belongsTo(Center::class, 'center_id', 'id');
    }

    public function classCategory() {
        return $this->belongsTo(ClassCategory::class, 'category_id');
    }

    public function entities() {
        return $this->hasMany(ClassEntity::class, 'template_id');
    }
}
