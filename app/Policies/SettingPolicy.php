<?php

namespace App\Policies;

use App\Models\Core\Setting;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class SettingPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        if ($user->hasPermissionTo('view settings')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Setting $setting): bool
    {
        if ($user->hasPermissionTo('view settings')) {
            return true;
        }
        return false;
    }
    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Setting $setting): bool
    {

        if ($user->hasPermissionTo('update setting')) {
            return true;
        }
        return false;
    }




}
