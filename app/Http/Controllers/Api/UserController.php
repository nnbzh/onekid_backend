<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\InitialUpdateRequest;
use App\Http\Resources\UserResource;
use App\Services\UserService;

class UserController extends Controller
{
    public function __construct(private UserService $userService) {}

    public function user() {
        return request()->user();
    }

    public function update(InitialUpdateRequest $request) {
        return new UserResource($this->userService->edit($request->user(), $request->validated()));
    }
}
