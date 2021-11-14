<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\BaseController;
use App\Http\Requests\PostChildRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class UserController extends BaseController
{
    private User $user;

    public function __construct()
    {
        $this->user = request()->user();
    }

    /**
     * @OA\Get (
     *     path="/api/v1/user",
     *     summary = "User info",
     *     operationId="user.info",
     *     tags={"User"},
     *     security={ {"bearer": {} }},
     *     @OA\Response(
     *         response="200",
     *         description="User info",
     *     )
     * )
     *
     * @return JsonResponse
     */
    public function user(): JsonResponse
    {
        return $this->successResponse(["user" => $this->user->load('profile')]);
    }

    public function addChild(PostChildRequest $request) {
        $data = $request->get('user');
        $child              = new User($data);
        $child->password    = Hash::make($data['password']);
        $child->parent_id   = $this->user->id;
        $child->is_verified = true;
        $child->saveOrFail();

        return $child->refresh();
    }

    /**
     * @OA\Get (
     *     path="/api/v1/user/children",
     *     summary = "User children",
     *     operationId="user.children",
     *     tags={"User"},
     *     security={ {"bearer": {} }},
     *     @OA\Response(
     *         response="200",
     *         description="Children",
     *     )
     * )
     *
     * @return JsonResponse
     */
    public function children()
    {
        return $this->successResponse($this->user->children()->get());
    }


}