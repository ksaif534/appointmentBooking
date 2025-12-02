<?php

namespace App\Policies;

use App\Models\StaffService;
use App\Models\User;

class StaffServicePolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, StaffService $staffService): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return $user->role !== 'customer';
    }

    public function update(User $user, StaffService $staffService): bool
    {
        return $user->role !== 'customer';
    }

    public function delete(User $user, StaffService $staffService): bool
    {
        return $user->role !== 'customer';
    }
}
