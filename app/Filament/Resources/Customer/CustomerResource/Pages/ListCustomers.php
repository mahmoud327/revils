<?php

namespace App\Filament\Resources\Customer\CustomerResource\Pages;

use App\Filament\Resources\Customer\CustomerResource;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use Filament\Pages\Actions;
use App\Models\User;


class ListCustomers extends ListRecords
{
    protected static string $resource = CustomerResource::class;

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
        ->where('account_type', 0);

    }

    protected function getTitle(): string
    {
        return trans('dashboard.customers.customers');

    }
}
