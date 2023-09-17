<?php

namespace App\Policies;

use App\Enums\UserType;
use App\Models\AbsenceStatus;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AbsenceStatusPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->type->value === UserType::COMPANY->value;
    }

    public function view(User $user, AbsenceStatus $absenceStatus): bool
    {
        if ($absenceStatus->company_id !== $user->company->id) {
            return false;
        }

        return $user->type->value === UserType::COMPANY->value;
    }

    public function create(User $user): bool
    {
        return false;
    }

    public function update(User $user, AbsenceStatus $absenceStatus): bool
    {
        if ($absenceStatus->company_id !== $user->company->id) {
            return false;
        }

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
