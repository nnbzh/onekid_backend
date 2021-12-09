<?php

namespace App\Models;


use App\Helpers\EntryStatus;

class ClassEntry extends TimestampedModel
{
    protected $table = 'class_entries';

    protected $fillable = [
        'id',
        'class_entity_id',
        'user_id',
        'status'
    ];

    public function entity() {
        return $this->belongsTo(ClassEntity::class, 'class_entity_id');
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
