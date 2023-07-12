<?php

namespace App\Repositories\User\Image;



interface ImageRepositoryInterface
{


    public function uploadProfileImage($request);
    public function uploadCoverImage($request);

}
