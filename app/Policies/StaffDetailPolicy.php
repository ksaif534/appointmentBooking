<?php

namespace App\Policies;

use App\Models\StaffDetail;
use App\Models\User;

class StaffDetailPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, StaffDetail $staffDetail): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return $user->role !== 'customer';
    }

    public function update(User $user, StaffDetail $staffDetail): bool
    {
        return $user->role !== 'customer';
    }

    public function delete(User $user, StaffDetail $staffDetail): bool
    {
        return $user->role !== 'customer';
    }
}
