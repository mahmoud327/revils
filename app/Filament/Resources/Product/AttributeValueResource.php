<?php

namespace App\Filament\Resources\Product;

use App\Filament\Resources\AttributeValueResource\RelationManagers\AttributesRelationManager;
use App\Filament\Resources\Product\AttributeValueResource\Pages;
use App\Models\Product\AttributeValue;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AttributeValueResource extends Resource
{
    use Translatable;

    protected static ?string $model = AttributeValue::class;
    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static ?string $navigationGroup = 'products';


    public static function getTranslatableLocales(): array
    {
        return ['en', 'ar'];
    }


    protected static function getNavigationLabel(): string
    {
        return trans('dashboard.products.attributes values');
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Forms\Components\TextInput::make('value')
                    ->label(trans('dashboard.name'))
                    ->required(),
                Select::make('attribute_id')
                    ->label(trans('dashboard.products.attributes'))
                    ->relationship('attribute', 'name')
                    ->required()
                    ->preload()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make('value')
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
            AttributesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAttributeValues::route('/'),
            'create' => Pages\CreateAttributeValue::route('/create'),
            'edit' => Pages\EditAttributeValue::route('/{record}/edit'),
        ];
    }
}
