<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait Imageable
{
    public function getImgUrlAttribute() {
        return config('filesystems.disks.public.url')."/$this->img_src";
    }
}