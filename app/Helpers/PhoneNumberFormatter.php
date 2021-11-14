<?php

namespace App\Helpers;

class PhoneNumberFormatter
{
    public static function clear(string $number): array|string|null
    {
        return preg_replace('/[^0-9]/', '', $number);
    }
}