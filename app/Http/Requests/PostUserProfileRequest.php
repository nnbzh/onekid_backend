<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostUserProfileRequest extends FormRequest
{
    /**
     * @OA\Post (
     *     path="/api/v1/user/profile",
     *     summary = "Create user profile",
     *     operationId="user.profile.create",
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
     *             example={"first_name": "Asik", "last_name": "Asik", "email": "asikn@gmail.com"}
     *           ),
     *           @OA\Property(
     *             property="profile",
     *             description="User profile object with info",
     *             type="string",
     *             example={"gender_id": 1, "birth_date": "01-01-2000"}
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
            "user.last_name"  => "nullable|string",
            "user.email"        => "required|email",
            "profile.gender_id" => "required|exists:genders,id",
            "profile.birth_date"=> "required|date",
        ];
    }
}