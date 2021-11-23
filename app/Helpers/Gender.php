<?php

namespace App\Helpers;

class Gender
{
    public const MALE   = 'm';
    public const FEMALE = 'f';

    public static function getRuName($key): ?string
    {
        return match ($key) {
            self::MALE      => 'Мужской',
            self::FEMALE    => 'Женский',
            default         => null
        };
    }
}