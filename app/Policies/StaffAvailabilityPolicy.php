<?php

namespace App\Policies;

use App\Models\StaffAvailability;
use App\Models\User;

class StaffAvailabilityPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, StaffAvailability $staffAvailability): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return $user->role !== 'customer';
    }

    public function update(User $user, StaffAvailability $staffAvailability): bool
    {
        return $user->role !== 'customer';
    }

    public function delete(User $user, StaffAvailability $staffAvailability): bool
    {
        return $user->role !== 'customer';
    }
}
