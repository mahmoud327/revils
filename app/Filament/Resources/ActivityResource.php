<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Grid;
use Filament\Tables\Columns\TextColumn;
use Spatie\Activitylog\Models\Activity;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\DateTimePicker;
use App\Filament\Resources\ActivityResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ActivityResource\RelationManagers;

class ActivityResource extends Resource
{
    protected static ?string $model = Activity::class;
    protected static ?string $navigationGroup = 'core';


    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static function getNavigationLabel(): string
    {
        return trans('dashboard.activities');
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        Grid::make(2)
                        ->schema([
                            TextInput::make('id'),


                            TextInput::make('properties.attributes.name')
                                ->label('Name'),

                            TextInput::make('properties.attributes.email')
                                ->label('Email'),


                            DateTimePicker::make('created_at')
                                ->label('Created'),
                            DateTimePicker::make('updated_at')
                                ->label('Updated'),
                        ])
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id'),

                TextColumn::make('event')
                ->label('event'),

                TextColumn::make('subject_type')
                ->label('type table'),

                TextColumn::make('subject.name')
                ->label('table id'),

                TextColumn::make('causer.name')
                ->label('user name'),


                TextColumn::make('created_at')
                    ->label('Logged At')
                    ->dateTime('d-M-Y'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListActivities::route('/'),
            'view' => Pages\ViewActivity::route('/{record}'),
        ];
    }
}
