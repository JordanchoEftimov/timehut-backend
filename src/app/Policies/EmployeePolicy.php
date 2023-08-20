<?php

namespace App\Policies;

use App\Enums\UserType;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EmployeePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->type->value === UserType::COMPANY->value;
    }

    public function view(User $user, Employee $employee): bool
    {
        if ($employee->company_id !== $user->company->id) {
            return false;
        }

        return $user->type->value === UserType::COMPANY->value;
    }

    public function create(User $user): bool
    {
        return $user->type->value === UserType::COMPANY->value;
    }

    public function update(User $user, Employee $employee): bool
    {
        if ($employee->company_id !== $user->company->id) {
            return false;
        }

        return $user->type->value === UserType::COMPANY->value;
    }

    public function delete(User $user, Employee $employee): bool
    {
        if ($employee->company_id !== $user->company->id) {
            return false;
        }

        return $user->type->value === UserType::COMPANY->value;
    }

    public function deleteAny(User $user): bool
    {
        return $user->type->value === UserType::COMPANY->value;
    }

    public function restore(User $user, Employee $employee): bool
    {
        if ($employee->company_id !== $user->company->id) {
            return false;
        }

        return $user->type->value === UserType::COMPANY->value;
    }

    public function forceDelete(User $user, Employee $employee): bool
    {
        if ($employee->company_id !== $user->company->id) {
            return false;
        }

        return $user->type->value === UserType::COMPANY->value;
    }
}
