<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource\Widgets\UserStatsOverview;
use App\Filament\Resources\UserResource;
use Illuminate\Database\Eloquent\Builder;
use Filament\Resources\Pages\ListRecords;
use Filament\Pages\Actions;
use App\Models\User;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
    // public function getHeaderWidgets():array
    // {
    //     return[
    //        UserStatsOverview::class
    //     ];
    // }

    protected function getTitle(): string
    {
        return trans('dashboard.admins');

    }
    public function getTableQuery(): Builder
    {
        return User::whereHas('roles', function ($q) {
            $q->where('name', '!=', 'seller')
                ->orwhere('name', '!=', 'customer');
        });
    }
}
