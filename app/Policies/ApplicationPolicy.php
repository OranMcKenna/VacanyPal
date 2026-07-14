<?php

namespace App\Policies;

use App\Enums\Role;
use App\Models\User;
use App\Models\Application;
use App\Models\Vacancy;


class ApplicationPolicy
{
    /**
     * Create a new policy instance.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Create a new policy instance.
     */
    public function view(User $user): bool
    {
        return $user->role === Role::ADMIN || $user->role === Role::EMPLOYER;
    }

    /**
     * Create a new policy instance.
     */
    public function create(User $user): bool
    {
        return $user->role == Role::GUEST;
    }

    /**
     * Create a new policy instance.
     */
    public function delete(User $user, Application $application)
    {
        return $user->role === Role::ADMIN || $user->role === Role::EMPLOYER;
    }
}
