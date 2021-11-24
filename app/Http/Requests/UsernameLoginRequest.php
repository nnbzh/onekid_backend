<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsernameLoginRequest extends FormRequest
{
    public function rules() {
        return [
            'username' => 'required',
            'password' => 'required'
        ];
    }
}
