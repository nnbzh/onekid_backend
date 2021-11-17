<?php

namespace App\Services;

use App\Helpers\PhoneNumberFormatter;
use App\Helpers\RandomCodeGenerator;
use App\Helpers\TokenHandler;
use App\Repositories\LoginRepository;
use App\Repositories\SmsRepository;
use App\Traits\IssuesToken;
use Illuminate\Support\Facades\Http;

class LoginService
{
    use IssuesToken;

    public function __construct(
        private LoginRepository $loginRepository,
        private SmsRepository $smsRepository,
    ) {}

    public function save($phone) {
        $phone  = PhoneNumberFormatter::clear($phone);
//        $code   = $phone % 10000;
        $code   = RandomCodeGenerator::generate();
        $this->smsRepository->send($phone, $code);

        return $this->loginRepository->save($phone, $code);
    }

    public function verifyCodeAndRespondWithTokens($request) {
        return $this->respondWithTokens($request, 'phone_number');
    }

    public function loginByUsername($request) {
        return $this->respondWithTokens($request, 'password');
    }

    private function respondWithTokens($request, $grant = 'phone_number') {
        $tokens = $this->issueToken($request, $grant);

        return TokenHandler::handle($tokens);
    }

}