<?php

namespace App\Repositories;

use Illuminate\Http\UploadedFile;

class ImageRepository
{
    public function store(UploadedFile $file, $path, $filename = null) {
        if (! $filename) {
            $filename = $file->getClientOriginalName();
        }

        $path = $file->storeAs($path, $filename);

        return str_replace('public/', '', $path);
    }
}
