<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AvatarPackResource;
use App\Models\AvatarPack;
use App\Repositories\AvatarPackRepository;
use App\Repositories\ImageRepository;
use Illuminate\Http\Request;

class AvatarPackController extends Controller
{
    public function __construct(private ImageRepository $imageRepository, private AvatarPackRepository $avatarPackRepository) {}

    public function index() {
        return AvatarPackResource::collection(AvatarPack::query()->get());
    }

    public function store(Request $request) {
        $this->validate($request, ['image' => 'required', 'name' => 'required']);
        $image = $request->file('image');
        $path = $this->imageRepository->store($image, 'public/avatars/pack');
        $avatar = AvatarPack::query()->create(['location' => $path, 'description' => $request->name]);

        return new AvatarPackResource($avatar);
    }
}
