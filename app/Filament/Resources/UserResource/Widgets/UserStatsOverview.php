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
            Card::make(trans('dashboard.products.products-pending'), auth()->user()->products()->pending()->count()),
            Card::make(trans('dashboard.products.products-approved'), auth()->user()->products()->approved()->count()),
            Card::make(trans('dashboard.products.products-rejected'), auth()->user()->products()->rejected()->count()),

        ];
    }
    public static function canView(): bool
    {
        return auth()->user()->hasRole('seller');
    }
}
