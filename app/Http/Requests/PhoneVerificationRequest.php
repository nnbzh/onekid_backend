<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PhoneVerificationRequest extends FormRequest
{
    /**
     * @OA\Post (
     *     path="/api/v1/verify",
     *     summary = "Verify code sent by sms(last 4 digits of number)",
     *     operationId="auth.verify",
     *     tags={"Auth"},
     *       @OA\RequestBody(
     *       required=true,
     *       @OA\MediaType(
     *         mediaType="application/json",
     *         @OA\Schema(
     *           @OA\Property(
     *             property="code",
     *             description="Code",
     *             type="integer",
     *             example="3077"
     *           ),
     *           @OA\Property(
     *             property="phone_number",
     *             description="Phone number",
     *             type="string",
     *             example="+7(777)4563077"
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
            "phone"     => "required|regex:/^(\s*)?(\+)?([- _():=+]?\d[- _():=+]?){10,14}(\s*)?$/",
            "code"      => "required|int"
        ];
    }
}