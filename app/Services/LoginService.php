<?php

namespace App\Services;

use App\Helpers\PhoneNumberFormatter;
use App\Helpers\Redis\RedisCache;
use App\Helpers\Redis\RedisKey;
use App\Helpers\TokenHandler;
use App\Repositories\SmsRepository;
use App\Repositories\UserRepository;
use App\Traits\IssuesToken;
use Illuminate\Http\Request;

class LoginService
{
    use IssuesToken;

    public function __construct(
        private SmsRepository $smsRepository,
        private UserRepository $userRepository,
        private RedisCache $redis
    ) {}

    public function requestCode($phone) {
        $phone  = PhoneNumberFormatter::clear($phone);
        $code   = $phone % 10000;
        $user   = $this->userRepository->findByPhoneOrCreate($phone);
        $this->redis->set(RedisKey::AUTH_CODE.$phone, [
            "code"      => $code,
            "user_id"   => $user->id
        ], 120);

//        $code   = RandomCodeGenerator::generate();
//        $this->smsRepository->send($phone, $code);

        return true;
    }

    public function auth(Request $request, $grant = 'phone_number') {
        $tokens = json_decode($this->issueToken($request, $grant)->getContent(), true);

        return $tokens['access_token'] ?? null;
    }

}