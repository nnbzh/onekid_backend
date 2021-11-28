<?php

namespace App\Services;

use App\Repositories\CategoryRepository;
use App\Repositories\ImageRepository;

class CategoryService
{
    public function __construct(
        private CategoryRepository $categoryRepository,
        private ImageRepository $imageRepository
    ) {}

    public function list()
    {
        return $this->categoryRepository->list();
    }

    public function create(array $validated)
    {
        $image = $validated['image'];
        $path = $this->imageRepository->store($image, 'public/categories');
        $validated['img_src'] = $path;

        return $this->categoryRepository->create($validated);
    }
}