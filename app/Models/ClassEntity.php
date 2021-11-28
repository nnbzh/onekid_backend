<?php

namespace App\Models;


class ClassEntity extends TimestampedModel
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    protected $table = 'class_entities';

    protected $fillable = [
        'weekday',
        'start_time',
        'end_time',
        'places_available',
        'template_id'
    ];

    public function template() {
        return $this->belongsTo(ClassTemplate::class, 'template_id');
    }
}