<?php

namespace App\Repositories;

use App\Helpers\RedisCache;
use App\Models\User;

class LoginRepository
{
    const  PHONE_CODE_REDIS_KEY = 'phone_number/code/';

    public function __construct(private RedisCache $redis) {}

    public function save($phone, $code) {
        $user = User::query()->firstOrCreate(['phone_number' => $phone]);

        $this->redis->set(self::PHONE_CODE_REDIS_KEY.$phone, [
            "code"      => $code,
            "user_id"   => $user->id
        ], 120);
        
        return $user;
    }
}