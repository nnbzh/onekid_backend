<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\ClassTemplateResource;
use App\Models\ClassCategory;

class ClassTemplateController
{
    public function index(ClassCategory $category) {
        return ClassTemplateResource::collection($category->templates()->with('center')->paginate(20));
    }
}
