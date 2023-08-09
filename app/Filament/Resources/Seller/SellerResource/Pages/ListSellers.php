<?php

namespace App\Filament\Resources\Seller\SellerResource\Pages;

use App\Filament\Resources\Seller\SellerResource;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use Filament\Pages\Actions;
use App\Models\User;


class ListSellers extends ListRecords
{
    protected static string $resource = SellerResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getTableQuery(): Builder
    {
        return User::query()
            ->latest()
            ->where('account_type', 1);
    }
    protected function getTitle(): string
    {
        return trans('dashboard.sellers.sellers');

    }
}
