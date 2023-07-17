<?php

namespace App\Providers;

use App\Filament\Resources\UserResource;
use Illuminate\Support\ServiceProvider;

use Filament\Facades\Filament;
use Filament\Navigation\NavigationItem;
use Filament\Navigation\UserMenuItem;

class FilementServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
        Filament::serving(function () {
            Filament::registerUserMenuItems([

                    UserMenuItem::make()
                    ->label('Admins')
                    ->url(UserResource::getUrl())
                    ->icon('heroicon-o-flag'),
            ]);
        });

    }
}
