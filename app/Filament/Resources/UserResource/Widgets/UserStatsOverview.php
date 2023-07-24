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
            Card::make(trans('dashboard.products.products-pending'), Product::pending()->count()),
            Card::make(trans('dashboard.products.products-approved'), Product::approved()->count()),
            Card::make(trans('dashboard.products.products-rejected'), Product::rejected()->count()),
            Card::make(trans('dashboard.sellers.sellers'), User::where('account_type', 1)->count()),
            Card::make(trans('dashboard.customers.customers'), User::where('account_type', 0)->count()),
        ];
    }
}
