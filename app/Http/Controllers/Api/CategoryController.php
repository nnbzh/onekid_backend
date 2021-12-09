<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\ClassCategory;
use App\Services\CategoryService;

class CategoryController extends Controller
{
    public function __construct(private CategoryService $categoryService) {}

    public function index()
    {
        return CategoryResource::collection($this->categoryService->list());
    }
}
