<?php

namespace App\Policies;

use App\Models\Core\State;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class StatePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
        if ($user->hasPermissionTo('view states')) {
            return true;
        }
        return false;
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, State $state): bool
    {
        //
        //
        if ($user->hasPermissionTo('view states')) {
            return true;
        }
        return false;
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
        //
        if ($user->hasPermissionTo('create state')) {
            return true;
        }
        return false;
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, State $state): bool
    {
        //
        //
        if ($user->hasPermissionTo('update state')) {
            return true;
        }
        return false;
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, State $state): bool
    {
        //
        if ($user->hasPermissionTo('delete state')) {
            return true;
        }
        return false;
        //
        //
    }
}
