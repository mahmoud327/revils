<?php

namespace App\Filament\Resources\Core;

use App\Filament\Resources\Core\RoleResource\Pages\CreateRole;
use App\Filament\Resources\Core\RoleResource\Pages\EditRole;
use App\Filament\Resources\Core\RoleResource\Pages\ListRoles;
use App\Filament\Resources\RoleResource\Pages;
use App\Filament\Resources\RoleResource\RelationManagers;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\MultiSelect;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Spatie\Permission\Models\Role;

class RoleResource extends Resource
{
    protected static ?string $model = Role::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static ?string $navigationGroup = 'Role and permisions';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Card::make()
                ->schema([
                    //
                    TextInput::make('name'),
                    MultiSelect::make('permissions')
                    ->relationship('permissions','name')
                    ->preload()

                ])

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                //
                Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('name')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('created_at')->dateTime('d-M-Y')->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
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
            'index' => ListRoles::route('/'),
            'create' => CreateRole::route('/create'),
            'edit' => EditRole::route('/{record}/edit'),
        ];
    }
}
