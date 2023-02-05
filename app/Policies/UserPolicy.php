<?php

namespace App\Policies;

use App\Enums\UserType;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->type->value === UserType::ADMIN->value;
    }

    public function view(User $user): bool
    {
        return $user->type->value === UserType::ADMIN->value;
    }

    public function create(User $user): bool
    {
        return $user->type->value === UserType::ADMIN->value;
    }

    public function update(User $user): bool
    {
        return $user->type->value === UserType::ADMIN->value;
    }

    public function delete(User $user, User $beingDeleted): bool
    {
        if ($beingDeleted->type->value === UserType::ADMIN->value) {
            return false;
        }

        return $user->type->value === UserType::ADMIN->value;
    }

    public function deleteAny(User $user): bool
    {
        return $user->type->value === UserType::ADMIN->value;
    }

    public function restore(User $user): bool
    {
        return $user->type->value === UserType::ADMIN->value;
    }

    public function forceDelete(User $user): bool
    {
        return $user->type->value === UserType::ADMIN->value;
    }
}
