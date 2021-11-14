<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsernameLoginRequest extends FormRequest
{
    /**
     * @OA\Post (
     *     path="/api/v1/login",
     *     summary = "Login with username(child)",
     *     operationId="auth.login_by_username",
     *     tags={"Auth"},
     *       @OA\RequestBody(
     *       required=true,
     *       @OA\MediaType(
     *         mediaType="application/json",
     *         @OA\Schema(
     *           @OA\Property(
     *             property="username",
     *             description="Username",
     *             type="string",
     *             example="asikn"
     *           ),
     *           @OA\Property(
     *             property="password",
     *             description="Password",
     *             type="string",
     *             example="pass1234"
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
            'username' => 'required',
            'password' => 'required'
        ];
    }
}