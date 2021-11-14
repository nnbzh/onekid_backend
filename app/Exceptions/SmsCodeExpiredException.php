<?php

namespace App\Exceptions;

class SmsCodeExpiredException extends \Exception
{
    protected $message  = 'Введенный вами код был просрочен, запросите другой год.';
    protected $code     = 400;
}