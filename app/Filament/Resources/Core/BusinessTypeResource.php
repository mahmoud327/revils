<?php

namespace App\Filament\Resources\Core;

use App\Filament\Resources\BusinessTypeResource\Pages;
use App\Filament\Resources\BusinessTypeResource\Pages\CreateBusinessType;
use App\Filament\Resources\BusinessTypeResource\Pages\EditBusinessType;
use App\Filament\Resources\BusinessTypeResource\Pages\ListBusinessTypes;
use App\Filament\Resources\BusinessTypeResource\RelationManagers;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\Concerns\Translatable;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\Card;
use App\Models\Core\BusinessType;
use Filament\Resources\Resource;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Forms;
use Filament\Tables;

class BusinessTypeResource extends Resource
{
    use Translatable;

    protected static ?string $model = BusinessType::class;
    protected static ?string $navigationGroup = 'core';


    protected static ?string $navigationIcon = 'heroicon-o-view-grid';


    public static function getTranslatableLocales(): array
    {
        return ['en', 'ar'];
    }


    protected static function getNavigationLabel(): string
    {
        return trans('dashboard.business types');
    }




    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([

                    Forms\Components\TextInput::make('name')
                        ->label('Name (Arabic)')
                        ->label(trans('dashboard.name'))
                        ->required(),




                ])
                //

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('name')
                ->label(trans('dashboard.name'))
                ->sortable()->searchable(),


            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => ListBusinessTypes::route('/'),
            'create' => CreateBusinessType::route('/create'),
            'edit' => EditBusinessType::route('/{record}/edit'),
        ];
    }
}
