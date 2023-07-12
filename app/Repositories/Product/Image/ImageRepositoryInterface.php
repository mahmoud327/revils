<?php

namespace App\Repositories\Product\Image;



interface ImageRepositoryInterface
{


    public function index($product);
    public function store($request, $product);
    public function destroy($product, $media);
    public function markFeatured($product, $media);
}
