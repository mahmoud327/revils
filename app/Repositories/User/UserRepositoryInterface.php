<?php

namespace App\Repositories\User;

interface UserRepositoryInterface
{
    public function sellerUpdateProfile($request);
    public function customerUpdateProfile($request);
    public function changePassword($request);
}
