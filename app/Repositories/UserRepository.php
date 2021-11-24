<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    public function findByPhoneOrCreate($phone) {
        return User::query()->firstOrCreate(['phone' => $phone]);
    }

    public function edit(User $user, $attributes) {
        $user->fill($attributes);
        $user->saveOrFail();

        return $user->refresh();
    }

    public function create($attributes) {
        return User::query()->create($attributes);
    }
}
