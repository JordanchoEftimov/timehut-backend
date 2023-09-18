<?php

namespace App\Policies;

use App\Enums\UserType;
use App\Models\Shift;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ShiftPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->type->value === UserType::EMPLOYEE->value;
    }

    public function view(User $user, Shift $shift): bool
    {
        if ($shift->employee_id !== $user->employee->id) {
            return false;
        }

        return $user->type->value === UserType::EMPLOYEE->value;
    }

    public function create(User $user): bool
    {
        return false;
    }

    public function update(User $user): bool
    {
        return false;
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

    // start and end shift policies
    public function startShift(User $user): bool
    {
        return $user->type->value === UserType::EMPLOYEE->value;
    }

    public function endShift(User $user): bool
    {
        return $user->type->value === UserType::EMPLOYEE->value;
    }
}
