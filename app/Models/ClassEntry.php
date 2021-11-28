<?php

namespace App\Models;


class ClassEntry extends TimestampedModel
{
    protected $table = 'class_entries';

    protected $fillable = [
        'id',
        'class_entity_id',
        'user_id',
        'status'
    ];

    public function classEntity() {
        return $this->belongsTo(ClassEntity::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
