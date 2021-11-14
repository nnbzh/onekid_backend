<?php

namespace App\Helpers;

class TokenHandler
{
    public static function handle(object $tokens) {
        $tokens = json_decode($tokens->getContent(), true);
        request()->headers->set("Authorization", "Bearer {$tokens['access_token']}");

        return $tokens;
    }
}