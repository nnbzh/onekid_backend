<?php

namespace App\Models;


use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Carbon\Carbon;

class ClassEntity extends TimestampedModel
{
    use CrudTrait;

    protected $table = 'class_entities';

    protected $fillable = [
        'weekday',
        'start_time',
        'finish_time',
        'places_available',
        'template_id'
    ];

    public function template() {
        return $this->belongsTo(ClassTemplate::class, 'template_id');
    }

    public function entries() {
        return $this->hasMany(ClassEntry::class);
    }

    public function isBookable() {
        return $this->hasAvailablePlaces() && $this->isInTime();
    }

    public function isInTime() {
        return $this->isEarlyBook() || $this->isTodayAndInTime();
    }

    public function isEarlyBook() {
        return now()->weekday() < $this->weekday;
    }

    public function isTodayAndInTime() {
        return now()->weekday() == $this->weekday && now()->diffInHours(Carbon::parse($this->start_time), false) >= 1;
    }

    public function hasAvailablePlaces() {
        return $this->entries()->count() < $this->places_available;
    }

    public function isBookedByUser($userIds) {
        return $this->entries()->whereIn('user_id', $userIds)->exists();
    }
}
