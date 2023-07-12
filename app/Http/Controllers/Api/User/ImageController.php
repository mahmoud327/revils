<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\Image\ImageRequest;
use App\Models\Core\MediaCenter;
use App\Repositories\User\Image\ImageRepositoryInterface;
use Illuminate\Http\Request;


class ImageController extends Controller
{
    public function __construct(public ImageRepositoryInterface $imageRepository)
    {
    }

    public function profileImage(ImageRequest $request)
    {
        $this->imageRepository->uploadProfileImage(request: $request);

        return responseSuccess(auth()->user()->profileImage);
    }
    public function coverImage(ImageRequest $request)
    {
        $this->imageRepository->uploadCoverImage(request: $request);
        return responseSuccess(auth()->user()->coverImage);
    }
}
