<?php

namespace App\Helpers;

class RandomCodeGenerator
{

    public static function generate($length = 4): int
    {
        $low = pow(10, $length - 1);
        $high = pow(10, $length) - 1;

        return rand($low, $high);
    }
}