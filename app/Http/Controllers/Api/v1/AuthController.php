<?php

namespace App\Http\Controllers\Api\v1;

use App\Helpers\TokenHandler;
use App\Http\Controllers\BaseController;
use App\Http\Requests\PhoneVerificationRequest;
use App\Http\Requests\SignupRequest;
use App\Http\Requests\UsernameLoginRequest;
use App\Services\LoginService;
use Illuminate\Http\JsonResponse;

class AuthController extends BaseController
{
    public function __construct(private LoginService $loginService) {}

    /**
     * @param SignupRequest $request
     * @return JsonResponse
     */
    public function auth(SignupRequest $request): JsonResponse
    {
        return $this->successResponse($this->loginService->save($request->get('phone_number')));
    }

    public function verify(PhoneVerificationRequest $request): JsonResponse
    {
        $tokens = $this->loginService->verifyCodeAndRespondWithTokens($request);

        return $this->successResponse(["auth" => $tokens, "user" => $request->user()]);
    }

    public function loginByUsername(UsernameLoginRequest $request): JsonResponse
    {
        $tokens = $this->loginService->loginByUsername($request);

        return $this->successResponse(["auth" => $tokens, "user" => $request->user()]);
    }
}