<?php

namespace App\Filament\Resources\Customer;

use App\Exports\CustomerExport;
use App\Filament\Resources\Customer\CustomerResource\Pages\CreateCustomer;
use App\Filament\Resources\Customer\CustomerResource\Pages\EditCustomer;
use App\Filament\Resources\Customer\CustomerResource\Pages\ListCustomers;
use App\Filament\Resources\Customer\CustomerResource\Pages\ShowCostomer;
use Illuminate\Database\Eloquent\Collection;


use App\Models\User as Customer;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Page;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Hash;

class CustomerResource extends Resource
{

    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $model = Customer::class;
    protected static ?string $slug = 'customers';


    protected static ?string $navigationGroup = 'users';

    protected static ?string $label = 'customer';
    protected static function getNavigationLabel(): string
    {
        return trans('dashboard.customers.customers');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([

                    //
                    Forms\Components\TextInput::make('username')->required()
                        ->label(trans('dashboard.user name'))

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
                            $livewire instanceof CreateCustomer,
                        )->dehydrated(
                            static fn (null|string $state): bool =>
                            filled($state),
                        )->label(
                            static fn (Page $livewire): string => ($livewire instanceof EditCustomer) ? trans('dashboard.new password') : trans('dashboard.password')
                        ),


                    RichEditor::make('bio')
                        ->label(trans('dashboard.bio')),



                    Fieldset::make('userProfile')
                        ->relationship('userProfile')
                        ->schema([
                            Forms\Components\TextInput::make('website')
                                ->label(trans('dashboard.customers.userProfile.website')),
                            Forms\Components\TextInput::make('phone')
                                ->label(trans('dashboard.customers.userProfile.phone')),
                            Forms\Components\TextInput::make('mobile')


                                ->label(trans('dashboard.customers.userProfile.mobile')),
                            Forms\Components\TextInput::make('street1')
                                ->label(trans('dashboard.customers.userProfile.street1')),


                            Forms\Components\TextInput::make('street2')
                                ->label(trans('dashboard.customers.userProfile.street2')),

                            Select::make('country_id')
                                ->label(trans('dashboard.customers.userProfile.country'))
                                ->relationship('country', 'name')
                                ->searchable(),

                            Select::make('city_id')
                                ->relationship('city', 'name')->required()
                                ->searchable(),

                            Select::make('state_id')
                                ->relationship('state', 'name')->required()
                                ->searchable(),



                        ]),

                    Repeater::make('userAddress')
                    ->relationship('userAddress')

                        ->schema([
                            TextInput::make('last_name'),
                            TextInput::make('first_name'),
                            TextInput::make('email'),
                            TextInput::make('mobile'),

                            Select::make('country_id')
                                ->label(trans('dashboard.customers.userProfile.country'))
                                ->relationship('country', 'name')
                                ->searchable(),

                            Select::make('city_id')
                                ->relationship('city', 'name')->required()
                                ->searchable(),

                            Select::make('state_id')
                                ->relationship('state', 'name')->required()
                                ->searchable(),

                            Select::make('address_type')
                                ->options([
                                    'home' => 'home',
                                    'office' => 'office',
                                    'other' => 'other',
                                ])
                               ,
                        ])
                        ->columns(2)
                ])
            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([

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

                Tables\Actions\BulkAction::make('export')
                    ->action(fn (Collection $records) => (new CustomerExport($records))->download('customers.xlsx'))
                    ->label('Export Selected')
                    ->icon('heroicon-o-document-download')
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
