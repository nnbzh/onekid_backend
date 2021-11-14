<?php

namespace App\Exceptions;

use Exception;

class InvalidCodeException extends Exception
{
    protected $code = 400;
    protected $message = "Введен неверный код.";
}