<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostChildRequest extends FormRequest
{
    /**
     * @OA\Post (
     *     path="/api/v1/user/children",
     *     summary = "Add child",
     *     operationId="user.children.add",
     *     tags={"User"},
     *     security={ {"bearer": {} }},
     *       @OA\RequestBody(
     *       required=true,
     *       @OA\MediaType(
     *         mediaType="application/json",
     *         @OA\Schema(
     *           @OA\Property(
     *             property="user",
     *             description="User object with info",
     *             type="string",
     *             example={"first_name": "Asik", "username": "asikn", "password" : "pass1234"}
     *           ),
     *         ),
     *       ),
     *     ),
     *     @OA\Response(
     *         response="201",
     *         description="New User",
     *     )
     * )
     *
     */
    public function rules() {
        return [
            "user.first_name"   => "required|string",
            "user.username"     => "required|string|unique:users,username",
            "user.password"     => "required"
        ];
    }
}