<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AvatarPack extends TimestampedModel
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    protected $table = 'avatar_packs';

    protected $fillable = [
        'description',
        'location'
    ];

    public function getUrlAttribute() {
        return config('filesystems.disks.public.url')."/$this->location";
    }
}
