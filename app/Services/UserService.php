<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;

class UserService
{
    public function __construct(private UserRepository $repository) {}

    public function create(array $attributes) {
        return $this->repository->create($attributes);
    }

    public function edit(User $user, $attributes) {
        return $this->repository->edit($user, $attributes);
    }
}
