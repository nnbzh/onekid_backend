<?php

namespace App\Http\Controllers\Api\v1;

use App\Helpers\TokenHandler;
use App\Http\Controllers\BaseController;
use App\Http\Requests\PhoneVerificationRequest;
use App\Http\Requests\SignupRequest;
use App\Http\Requests\UsernameLoginRequest;
use App\Services\LoginService;
use App\Traits\ApiResponse;
use App\Traits\IssuesToken;
use Illuminate\Http\JsonResponse;

class AuthController extends BaseController
{
    use IssuesToken, ApiResponse;

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
        $tokens = TokenHandler::handle($this->issueToken($request));

        return $this->successResponse([
            "auth" => $tokens,
            "user" => $request->user()
        ]);
    }

    public function loginByUsername(UsernameLoginRequest $request): JsonResponse
    {
        $tokens = TokenHandler::handle($this->issueToken($request, 'password'));

        return $this->successResponse([
            "auth" => $tokens,
            "user" => $request->user()
        ]);
    }
}