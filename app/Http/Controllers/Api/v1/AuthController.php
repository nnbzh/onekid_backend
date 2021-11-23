<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\PhoneVerificationRequest;
use App\Http\Requests\SignupRequest;
use App\Http\Requests\UsernameLoginRequest;
use App\Http\Resources\UserResource;
use App\Services\LoginService;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    public function __construct(private LoginService $loginService) {}

    /**
     * @param SignupRequest $request
     * @return JsonResponse
     */
    public function auth(SignupRequest $request): JsonResponse
    {
        return response()->json(['success' => $this->loginService->requestCode($request->get('phone'))]);
    }

    public function verify(PhoneVerificationRequest $request)
    {
        $accessToken = $this->loginService->auth($request);
        request()->headers->set('Authorization', "Bearer $accessToken");

        return (new UserResource(request()->user('api')))->additional(['access_token' => $accessToken]);
    }

    public function login(UsernameLoginRequest $request)
    {
        $accessToken = $this->loginService->auth($request, 'password');
        request()->headers->set('Authorization', "Bearer $accessToken");

        return (new UserResource(request()->user('api')))->additional(['access_token' => $accessToken]);
    }
}