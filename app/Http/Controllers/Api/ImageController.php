<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\ImageRepository;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function __construct(private ImageRepository $imageRepository) {}

    public function store(Request $request) {
        $this->validate($request, ['image' => 'required|file']);
        $path = $this->imageRepository->store($request->file('image'), "public/user-{$request->user()->id}");

        return response()->json(['data' => ['url' => config('filesystems.disks.public.url')."/$path"]]);
    }
}
