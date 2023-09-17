<?php

namespace App\Policies;

use App\Enums\UserType;
use App\Models\Salary;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SalaryPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->type->value === UserType::EMPLOYEE->value;
    }

    public function view(User $user, Salary $salary): bool
    {
        if ($salary->employee_id !== $user->employee->id) {
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
}
