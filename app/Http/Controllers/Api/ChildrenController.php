<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostChildRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;

class ChildrenController extends Controller
{
    public function __construct(private UserService $userService) {}

    public function store(PostChildRequest $request) {
        $this->authorize('create', User::class);
        $validated = array_merge($request->validated(), ['parent_id' => $request->user()->id]);

        return new UserResource($this->userService->create($validated));
    }

    public function index(Request $request) {
        return UserResource::collection($request->user()->children()->get());
    }

    public function destroy(User $child) {
        $this->authorize('delete', $child);
        $child->delete();

        return response()->noContent();
    }
}
