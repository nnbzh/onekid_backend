<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCategoryRequest extends FormRequest
{
    public function rules() {
        return [
            'name'  => 'required|string',
            'slug'  => 'required|string',
            'image' => 'required|file',
        ];
    }
}