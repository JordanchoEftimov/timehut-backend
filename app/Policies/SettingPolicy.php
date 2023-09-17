<?php

namespace App\Policies;

use App\Enums\UserType;
use App\Models\User;

class SettingPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->type->value === UserType::COMPANY->value;
    }

    public function view(User $user): bool
    {
        return $user->type->value === UserType::COMPANY->value;
    }

    public function create(User $user): bool
    {
        return false;
    }

    public function update(User $user): bool
    {
        return $user->type->value === UserType::COMPANY->value;
    }

    public function delete(User $user): bool
    {
        return false;
    }

    public function deleteAny(User $user): bool
    {
        return false;
    }

    public function restore(User $user): bool
    {
        return false;
    }

    public function forceDelete(User $user): bool
    {
        return false;
    }
}
