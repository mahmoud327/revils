<?php

namespace App\Filament\Resources\SellerResource\Pages;

use App\Filament\Resources\SellerResource;
use App\Models\User;
use Filament\Resources\Pages\Page;

class ShowSeller extends Page
{
    protected static string $resource = SellerResource::class;

    protected static string $view = 'filament.resources.seller-resource.pages.show-seller';

    public function getData(): ?object
    {

        $id = request()->segment(4);
        $result = User::with('businessProfile')->find($id);

        return $result;
    }

}
