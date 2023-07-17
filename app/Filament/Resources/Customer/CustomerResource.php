<?php

namespace App\Filament\Resources\Customer;

use App\Filament\Resources\Customer\CustomerResource\Pages\CreateCustomer;
use App\Filament\Resources\Customer\CustomerResource\Pages\EditCustomer;
use App\Filament\Resources\Customer\CustomerResource\Pages\ListCustomers;
use App\Filament\Resources\Customer\CustomerResource\Pages\ShowCostomer;
use App\Filament\Resources\CustomerResource\Pages;

use App\Filament\Resources\CustomerResource\RelationManagers;

use App\Models\User as Customer;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Pages\Page;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Hash;

class CustomerResource extends Resource
{

    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $model = Customer::class;
    protected static ?string $slug = 'customers';


    protected static ?string $navigationGroup = 'users';

    protected static ?string $label = 'customer';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Forms\Components\TextInput::make('username')->required()->unique(ignoreRecord: true),
                Forms\Components\TextInput::make('first_name')->unique(ignoreRecord: true),
                Forms\Components\TextInput::make('last_name')->unique(ignoreRecord: true),

                Forms\Components\TextInput::make('email')->email()->required()->unique(ignoreRecord: true),
                Forms\Components\TextInput::make('password')
                    ->password()
                    ->maxLength(255)
                    ->dehydrateStateUsing(
                        static fn (null|string $state): null|string =>
                        filled($state) ? Hash::make($state) : null,
                    )->required(
                        static fn (Page $livewire): bool =>
                        $livewire instanceof CreateCustomer,
                    )->dehydrated(
                        static fn (null|string $state): bool =>
                        filled($state),
                    )->label(
                        static fn (Page $livewire): string => ($livewire instanceof EditCustomer) ? 'New Password' : 'Password'
                    ),


                RichEditor::make('bio')
                    ->label('bio'),



                Fieldset::make('userProfile')
                    ->relationship('userProfile')
                    ->schema([
                        Forms\Components\TextInput::make('website'),
                        Forms\Components\TextInput::make('phone'),
                        Forms\Components\TextInput::make('mobile'),
                        Forms\Components\TextInput::make('street1'),


                        Forms\Components\TextInput::make('street2'),

                        Select::make('country_id')
                            ->relationship('country', 'name'),

                        // Select::make('city_id')
                        //     ->relationship('city', 'name')->required(),

                        // Select::make('state_id')
                        //     ->relationship('state', 'name')->required(),



                    ]),

            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\TextColumn::make('username')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('first_name')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('last_name')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('email')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('created_at')->dateTime('d-M-Y')->sortable(),



                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\Action::make('show')
                    ->url(fn (User $record) => 'customers/show/' . $record->id),

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
            'index' => ListCustomers::route('/'),
            'create' => CreateCustomer::route('/create'),
            'edit' => EditCustomer::route('/{record}/edit'),
            'show' => ShowCostomer::route('/show/{id}'),

        ];

    }
}
