<?php

namespace App\Policies;

use App\Models\Product\AttributeValue;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class AttributeValuePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
        //
        if ($user->hasPermissionTo('view attribute values')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, AttributeValue $attributeValue): bool
    {
        //
        //
        if ($user->hasPermissionTo('view attribute values')) {
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
        if ($user->hasPermissionTo('create attribute values')) {
            return true;
        }
        return false;
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, AttributeValue $attributeValue): bool
    {
        //
        //
        if ($user->hasPermissionTo('update attribute values')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, AttributeValue $attributeValue): bool
    {
        //
        //
        if ($user->hasPermissionTo('delete attribute values')) {
            return true;
        }
        return false;
    }
}
