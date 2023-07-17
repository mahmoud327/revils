<?php

namespace App\Policies;

use App\Models\Core\BusinessType;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class BusinessTypePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
        if ($user->hasPermissionTo('view Business Types')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, BusinessType $businessType): bool
    {
        //
        if ($user->hasPermissionTo('view Business Types')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
        if ($user->hasPermissionTo('create Business Type')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, BusinessType $businessType): bool
    {
        //
        if ($user->hasPermissionTo('update Business Type')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, BusinessType $businessType): bool
    {
        //
        if ($user->hasPermissionTo('delete Business Type')) {
            return true;
        }
        return false;
    }

}
