<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InitialUpdateRequest extends FormRequest
{
    public function rules() {
        return [
            "first_name"    => "required|string",
            "last_name"     => "nullable|string",
            "email"         => "required|email",
            "gender"        => "required|string|in:m,f",
            "birth_date"    => "required|date",
        ];
    }
}