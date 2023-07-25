<?php

namespace App\Filament\Resources\Core;

use App\Filament\Resources\Core\CityResource\Pages;
use App\Filament\Resources\Core\CityResource\RelationManagers;
use App\Models\Core\City;
use App\Models\Core\State;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CityResource extends Resource
{
    use Translatable;

    protected static ?string $model = City::class;

    protected static ?string $navigationIcon = 'heroicon-o-flag';
    protected static ?string $navigationGroup = 'regions';

    public static function getTranslatableLocales(): array
    {
        return ['en', 'ar'];
    }


    protected static function getNavigationLabel(): string
    {
        return trans('dashboard.cities');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Forms\Components\TextInput::make('name')
                    ->label('Name')
                    ->label(trans('dashboard.name'))

                    ->required()
                    ->unique(ignoreRecord: true),

                // Select::make('state_id')
                //     ->label('state')
                //     ->relationship('state', 'name')

                Select::make('state_id')
                    ->relationship('state', 'name')
                    ->label(trans('dashboard.states'))

                    ->searchable()
                    ->required(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make('name')
                ->label(trans('dashboard.name'))

                ->sortable()->searchable(),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListCities::route('/'),
            'create' => Pages\CreateCity::route('/create'),
            'edit' => Pages\EditCity::route('/{record}/edit'),
        ];
    }
}
