<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseController;
use App\Http\Requests\InitialUpdateRequest;
use Illuminate\Http\JsonResponse;

class UserProfileController extends BaseController
{
    public function create(InitialUpdateRequest $request): JsonResponse
    {
        $user = $request->user();
        $user->update($request->get('user'));
        $user->profile()->create($request->get('profile'));

        return $this->successResponse($user->load('profile')->toArray(), 201);
    }
}
