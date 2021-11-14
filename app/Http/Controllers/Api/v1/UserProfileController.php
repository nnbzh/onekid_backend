<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\BaseController;
use App\Http\Requests\PostUserProfileRequest;
use Illuminate\Http\JsonResponse;

class UserProfileController extends BaseController
{
    public function create(PostUserProfileRequest $request): JsonResponse
    {
        $user = $request->user();
        $user->update($request->get('user'));
        $user->profile()->create($request->get('profile'));

        return $this->successResponse($user->load('profile')->toArray(), 201);
    }
}