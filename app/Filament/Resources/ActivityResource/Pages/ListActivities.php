<?php

namespace App\Filament\Resources\ActivityResource\Pages;

use App\Filament\Resources\ActivityResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use Spatie\Activitylog\Models\Activity;



class ListActivities extends ListRecords
{
    protected static string $resource = ActivityResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
    protected function getTitle(): string
    {
        return trans('dashboard.activities');

    }


    protected function getTableQuery(): Builder
    {
        return Activity::query()
            ->latest();
    }
}
