<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Http;

class SmsRepository
{
    private string $host;
    private string $version;
    private string $apiKey;

    public function __construct()
    {
        $this->host     = env('SMS_API_HOST');
        $this->version  = env('SMS_API_VERSION');
        $this->apiKey   = env('SMS_API_KEY');
    }

    public function send($phone, $code) {
        $body = [
            'recipient' => "$phone",
            'text'      => "Код для входа в приложение: $code",
        ];

        return Http::post(
            "$this->host/service/Message/sendSmsMessage?output=json&api={$this->version}&apiKey={$this->apiKey}", $body
        )->json();
    }
}