<?php

namespace App\Filament\Resources\Product;

use App\Filament\Resources\AttributeValueResource\RelationManagers\AttributesRelationManager;
use App\Filament\Resources\Product\AttributeResource\Pages;
use App\Filament\Resources\Product\AttributeResource\RelationManagers;
use App\Models\Product\Attribute;
use Filament\Forms;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AttributeResource extends Resource
{
    use Translatable;
    protected static ?string $model = Attribute::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static ?string $navigationGroup = 'products';

    public static function getTranslatableLocales(): array
    {
        return ['en', 'ar'];
    }

    protected static function getNavigationLabel(): string
    {
        return trans('dashboard.products.attributes');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                ->label(trans('dashboard.name'))
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
            AttributesRelationManager::class

        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAttributes::route('/'),
            'create' => Pages\CreateAttribute::route('/create'),
            'edit' => Pages\EditAttribute::route('/{record}/edit'),
        ];
    }
}
