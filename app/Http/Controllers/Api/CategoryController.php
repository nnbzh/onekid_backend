<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Services\CategoryService;

class CategoryController extends Controller
{
    public function __construct(private CategoryService $categoryService) {}

    public function index()
    {
        return CategoryResource::collection($this->categoryService->list());
    }

    public function store(CreateCategoryRequest $request) {
        return new CategoryResource($this->categoryService->create($request->validated()));
    }
}
