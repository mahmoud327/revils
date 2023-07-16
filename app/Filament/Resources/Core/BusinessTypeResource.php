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

    protected static ?string $navigationIcon = 'heroicon-o-view-grid';


    public static function getTranslatableLocales(): array
    {
        return ['en', 'ar'];
    }



    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([

                    Forms\Components\TextInput::make('name')
                        ->label('Name (Arabic)')
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
                Tables\Columns\TextColumn::make('name')->sortable()->searchable(),


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