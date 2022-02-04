<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;

trait Imageable
{
    public function getImgUrlAttribute() {
        return config('filesystems.disks.public.url')."/$this->img_src";
    }

    public function setImgSrcAttribute($value) {
        $attribute_name = "img_src";
        $table = $this->getTable();
        $disk = 'public';

        if ($value == null) {
            Storage::disk($disk)->delete("$table/". $this->{$attribute_name});

            $this->attributes[$attribute_name] = null;
        }

        // if a base64 was sent, store it in the db
        if (Str::startsWith($value, 'data:image')) {
            // 0. Make the image
            // 1. Generate a filename.
            $image = Image::make($value)->encode('jpg', 90);

            // 1. Generate a filename.
            $filename = md5($value . time()) . '.jpg';

            // 2. Store the image on disk.
            Storage::disk($disk)->put("$table/$filename", $image->stream());

            // 3. Delete the previous image, if there was one.
            Storage::disk($disk)->delete($this->{$attribute_name});

            // 4. Save the public path to the database
            // but first, remove "public/" from the path, since we're pointing to it
            // from the root folder; that way, what gets saved in the db
            // is the public URL (everything that comes after the domain name)
            $publicDestinationPath = Str::replaceFirst('public/', '', '');

            $this->attributes[$attribute_name] = "$table/$filename";
        }
    }
}
