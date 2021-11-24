<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    public function create(User $user) {
        return $user->isParent();
    }

    public function update(User $user, User $second) {
        return $second->parent_id = $user->id || $user->id == $second->id;
    }

    public function delete(User $user, User $second) {
        return $second->parent_id = $user->id || $user->id == $second->id;
    }

    public function view(User $user, User $second) {
        return $second->parent_id = $user->id || $user->id == $second->id;
    }
}
