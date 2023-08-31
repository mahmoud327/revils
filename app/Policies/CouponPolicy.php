<?php

namespace App\Policies;

use App\Models\Core\Coupon;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CouponPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
        //
        if ($user->hasPermissionTo('view coupons')) {
            return true;
        }
        return false;
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Coupon $coupon): bool
    {
        //
        //
        if ($user->hasPermissionTo('view coupons')) {
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
        if ($user->hasPermissionTo('create coupons')) {
            return true;
        }
        return false;
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Coupon $coupon): bool
    {
        //
        //
        if ($user->hasPermissionTo('update coupons')) {
            return true;
        }
        return false;
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Coupon $coupon): bool
    {
        //
        //
        if ($user->hasPermissionTo('delete coupons')) {
            return true;
        }
        return false;
        //
    }
}
