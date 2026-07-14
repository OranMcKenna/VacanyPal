<?php

namespace App\Policies;

use App\Enums\Role;
use App\Models\Vacancy;
use App\Models\User;

class VacancyPolicy
{
    /**
     * Determine whether the user is an admin and authorise all actions
     */
    public function before(User $user, string $ability): bool|null
    {
        if ($user->role == Role::ADMIN && $ability != 'create') {
            return true;
        } else {
            return null;
        }
    }

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model
     */
    public function view(User $user): bool
    {
        return true;
    }

    /**
     * Determine if the user can create a vacancy.
     */
    public function create(User $user)
    {
        return $user->role == Role::EMPLOYER;
    }

    /**
     * Determine if the user can update a vacancy.
     */
    public function update(User $user)
    {
        return $user->role == Role::EMPLOYER || $user->role == Role::ADMIN;
    }

    /**
     * Determine if the user can delete a vacancy.
     */
    public function delete(User $user)
    {
        return $user->role == Role::EMPLOYER || $user->role == Role::ADMIN;
    }
}
