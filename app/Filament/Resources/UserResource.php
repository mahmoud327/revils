<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\Pages\CreateUser;
use App\Filament\Resources\UserResource\Pages\EditUser;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Filament\Resources\UserResource\Widgets\UserStatsOverview;
use App\Models\User;
use Filament\Pages\Page;

use Filament\Forms;
use Filament\Forms\Components\CheckboxList;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserResource extends Resource
{
    protected static ?string $navigationIcon = 'heroicon-o-flag';

    protected static ?string $navigationGroup = 'Admin';
    protected static ?string $model = User::class;
    protected static ?string $label = 'admin';
    protected static function getNavigationLabel(): string
    {
        return trans('dashboard.admins');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Forms\Components\TextInput::make('username')->required()
                    ->label(trans('dashboard.user name'))

                    ->unique(ignoreRecord: true),

                Forms\Components\TextInput::make('name')->required()
                    ->label(trans('dashboard.user name'))

                    ->unique(ignoreRecord: true),

                Forms\Components\TextInput::make('mobile')->required()
                    ->label(trans('dashboard.mobile'))
                    ->required()
                    ->unique(ignoreRecord: true),

                Forms\Components\TextInput::make('first_name')
                    ->label(trans('dashboard.first name'))

                    ->unique(ignoreRecord: true),
                Forms\Components\TextInput::make('last_name')
                    ->label(trans('dashboard.last name'))

                    ->unique(ignoreRecord: true),

                Forms\Components\TextInput::make('email')->email()
                    ->label(trans('dashboard.email'))

                    ->required()->unique(ignoreRecord: true),
                Forms\Components\TextInput::make('password')
                    ->label(trans('dashboard.password'))


                    ->password()
                    ->maxLength(255)
                    ->dehydrateStateUsing(
                        static fn (null|string $state): null|string =>
                        filled($state) ? Hash::make($state) : null,
                    )->required(
                        static fn (Page $livewire): bool =>
                        $livewire instanceof CreateUser,
                    )->dehydrated(
                        static fn (null|string $state): bool =>
                        filled($state),
                    )->label(
                        static fn (Page $livewire): string => ($livewire instanceof EditUser) ? trans('dashboard.new password') : trans('dashboard.password')
                    ),

                CheckboxList::make('roles')
                    ->relationship('roles', 'name')
                    ->columns(2)
                    ->label(trans('dashboard.roles.roles'))

                    ->helperText(trans('dashboard.roles.choose any roles'))
                    ->required()
            ]);
    }
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make('username')
                    ->label(trans('dashboard.user name'))
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('first_name')
                    ->sortable()
                    ->label(trans('dashboard.first name'))

                    ->searchable(),
                Tables\Columns\TextColumn::make('last_name')
                    ->label(trans('dashboard.last name'))

                    ->sortable()->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->label(trans('dashboard.email'))

                    ->sortable()->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(trans('dashboard.created at'))

                    ->dateTime('d-M-Y')->sortable(),




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
            //-
        ];
    }

    public static function getWidgets(): array
    {
        return [
            UserStatsOverview::class
        ];
    }



    protected function getTableQuery(): Builder
    {
        return User::where('account_type', 1);
    }


    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
            'activities' => Pages\ListUserActivites::route('/{record}/activities'),
        ];
    }
}
