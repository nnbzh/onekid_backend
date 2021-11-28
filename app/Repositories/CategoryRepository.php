<?php

namespace App\Repositories;

use App\Models\ClassCategory;

class CategoryRepository
{
    public function list() {
        return ClassCategory::query()->withCount('templates')->get();
    }

    public function create(array $validated)
    {
        return ClassCategory::query()->create($validated);
    }
}