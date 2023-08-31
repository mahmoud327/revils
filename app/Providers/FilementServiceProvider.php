<?php

namespace App\Providers;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\ServiceProvider;
use Filament\Http\Responses\Auth\Contracts\LoginResponse;
use DutchCodingCompany\FilamentSocialite\FilamentSocialite;
use Laravel\Socialite\Contracts\User as SocialiteUserContract;
use DutchCodingCompany\FilamentSocialite\Facades\FilamentSocialite as FilamentSocialiteFacade;
use Filament\Facades\Filament;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Navigation\NavigationItem;

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
        // Filament::serving(function () {
        //     Filament::registerNavigationItems([
        //         NavigationItem::make('Settings')
        //             ->label(trans('dashboard.settings.settings'))
        //             ->url(route('filament.pages.settings'))
        //             ->icon('heroicon-o-cog'),
        //     ]);
        // });

        // \Reworck\FilamentSettings\FilamentSettings::setFormFields([

        //     //phone
        //     TextInput::make('email')
        //         ->label(trans('dashboard.settings.email')),
        //     //phone
        //     TextInput::make('phone')
        //         ->label(trans('dashboard.settings.phone')),
        //     //
        //     TextInput::make('vat')
        //         ->label(trans('dashboard.settings.vat'))
        //         ->numeric(),
        //     //
        //     TextInput::make('fb_link')
        //         ->label(trans('dashboard.settings.fb_link')),

        //     TextInput::make('skype_link')
        //         ->label(trans('dashboard.settings.skype_link')),

        //     TextInput::make('tw_link')
        //         ->label(trans('dashboard.settings.tw_link')),

        //     TextInput::make('linkedin_link')
        //         ->label(trans('dashboard.settings.linkedin_link')),

        //     TextInput::make('whatsapp')
        //         ->label(trans('dashboard.settings.whatsapp')),

        //     TextInput::make('inst_link')
        //         ->label(trans('dashboard.settings.inst_link')),

        //     RichEditor::make('about_us')
        //         ->label(trans('dashboard.settings.about_us')),

        //     RichEditor::make('terms_condition')
        //         ->label(trans('dashboard.settings.terms_condition')),
        // ]);
    }
}
