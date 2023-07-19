<?php

namespace App\Filament\Resources\UserResource\Widgets;

use App\Models\Product\Product;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class UserStatsOverview extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            //
            Card::make('products-pennding', Product::pennding()->count()),
            Card::make('products-approve', Product::approved()->count()),
            Card::make('products-rejected', Product::rejected()->count()),
            Card::make('seller', User::where('account_type',1)->count()),
            Card::make('customer', User::where('account_type',0)->count()),
        ];
    }
}
