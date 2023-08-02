<?php

namespace App\Filament\Resources\Product;

use App\Filament\Resources\Product\RateResource\Pages;
use App\Filament\Resources\Product\RateResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Multicaret\Acquaintances\Interaction;

class RateResource extends Resource
{
    protected static ?string $model = Interaction::class;
    protected static ?string $navigationGroup = 'products';

    protected static ?string $slug = 'rates';

    protected static function getNavigationLabel(): string
    {
        return trans('dashboard.products.rates');
    }

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make('id'),

                //
                Tables\Columns\TextColumn::make('relation_value')
                    ->label(trans('dashboard.products.rate'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('subject_id')
                ->label(trans('dashboard.products.id'))
                ->searchable()
                ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListRates::route('/'),
        ];
    }
}
