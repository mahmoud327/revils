<?php

namespace App\Policies;

use App\Models\User;
use App\Models\UserCart;

class CartPolicy
{
    /**
     * Create a new policy instance.
     */

    public function create(User $user, UserCart $userCart): bool
    {
        return $user->id === $userCart->user_id;
    }
}
