<?php


namespace App\Repositories\User\Image;

use App\Models\Core\MediaCenter;
use App\Models\Product\Attribute;
use App\Models\Product\Product;
use App\Repositories\Base\BaisRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;


class ImageRepository implements ImageRepositoryInterface
{

    public function uploadProfileImage($request)
    {
        auth()->user()->clearMediaCollection('profile');

        auth()->user()->addMedia($request->image)
            ->toMediaCollection('profile');
    }

    public function uploadCoverImage($request)
    {

        auth()->user()->clearMediaCollection('cover');

        auth()->user()->addMedia($request->image)
            ->toMediaCollection('cover');
    }
}
