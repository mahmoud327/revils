<?php

namespace App\Filament\Resources\UserResource\Widgets;

use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class UserStatsOverview extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            //
            Card::make('seller', User::where('account_type',1)->count()),
            Card::make('customer', User::where('account_type',0)->count()),
        ];
    }
}
