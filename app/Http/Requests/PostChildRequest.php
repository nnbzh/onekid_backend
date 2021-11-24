<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostChildRequest extends FormRequest
{
    public function rules() {
        return [
            "first_name"   => "required|string",
            "username"     => "required|string|unique:users,username",
            "password"     => "required",
            'avatar_url'   => "nullable|string"
        ];
    }
}
