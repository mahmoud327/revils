<?php


namespace App\Repositories\Product\Image;

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
    public function index($product)
    {
        return $product->images;
    }

    public function store($request, $product)
    {
        $product->update(['images' => $request->images]);
        $product->load('media');
    }
    public function destroy($product, $media)
    {
        $media->delete();
    }
    public function markFeatured($product, $image)
    {
        $image->forgetCustomProperty('isFeatured');
        $image->save();

        $image->setCustomProperty('isFeatured', true);
        $image->save();
        $image = $image->refresh();
    }
}
