<?php

namespace App\Filament\Resources\CustomerResource\Pages;

use App\Filament\Resources\CustomerResource;
use App\Models\User;
use Filament\Resources\Pages\Page;

class ShowCostomer extends Page
{
    protected static string $resource = CustomerResource::class;

    protected static string $view = 'filament.resources.customer-resource.pages.show-costomer';

    public function getData(): ?object
    {

        $id = request()->segment(4);
        $result = User::with('userProfile')->find($id);

        return $result;
    }
}
