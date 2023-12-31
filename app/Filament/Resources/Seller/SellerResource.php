<?php

namespace App\Filament\Resources\Seller;

use App\Exports\SellerExport;
use App\Filament\Resources\Core\SellerResource\Pages;

use App\Filament\Resources\Core\SellerResource\RelationManagers;
use App\Filament\Resources\Seller\SellerResource\Pages\CreateSeller;
use App\Filament\Resources\Seller\SellerResource\Pages\EditSeller;
use App\Filament\Resources\Seller\SellerResource\Pages\ListSellers;
use App\Filament\Resources\Seller\SellerResource\Pages\ShowSeller;
use App\Models\Core\Translation\BusinessType as TranslationBusinessType;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\RichEditor;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Illuminate\Support\Facades\Hash;
use App\Models\Core\BusinessType;
use App\Models\User as Seller;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Resources\Form;
use Filament\Pages\Page;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Tables;
use Illuminate\Database\Eloquent\Collection;

class SellerResource extends Resource
{
    protected static ?string $model = Seller::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';
    protected static ?string $navigationGroup = 'users';
    protected static ?string $slug = 'sellers';
    protected static ?string $label = 'sellers';
    protected static function getNavigationLabel(): string
    {
        return trans('dashboard.sellers.sellers');
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Card::make()->schema([

                    Forms\Components\TextInput::make('username')
                        ->required()->unique(ignoreRecord: true)
                        ->label(trans('dashboard.name')),

             

                    Forms\Components\TextInput::make('first_name')
                        ->label(trans('dashboard.first name'))

                        ->unique(ignoreRecord: true),

                        Forms\Components\TextInput::make('mobile')->required()
                        ->label(trans('dashboard.mobile'))
                        ->required()
                        ->unique(ignoreRecord: true),

                    Forms\Components\TextInput::make('last_name')->unique(ignoreRecord: true)
                        ->label(trans('dashboard.last name')),
                    Forms\Components\TextInput::make('email')->email()
                        ->label(trans('dashboard.email'))

                        ->unique(ignoreRecord: true),
                    Forms\Components\TextInput::make('password')
                        ->password()
                        ->label(trans('dashboard.password'))

                        ->maxLength(255)
                        ->dehydrateStateUsing(
                            static fn (null|string $state): null|string =>
                            filled($state) ? Hash::make($state) : null,
                        )->required(
                            static fn (Page $livewire): bool =>
                            $livewire instanceof CreateSeller,
                        )->dehydrated(
                            static fn (null|string $state): bool =>
                            filled($state),
                        )->label(
                            static fn (Page $livewire): string => ($livewire instanceof EditSeller) ? trans('dashboard.new password') : trans('dashboard.password')
                        ),
                    RichEditor::make('bio')
                        ->label(trans('dashboard.bio'))
                        ->required(),
                    Hidden::make('account_type')->default(1),

                    Fieldset::make('businessProfile')

                        ->relationship('businessProfile')
                        ->schema([
                            Forms\Components\TextInput::make('website')
                                ->label(trans('dashboard.sellers.businessProfile.website'))
                                ->required(),
                            Forms\Components\TextInput::make('phone')
                                ->label(trans('dashboard.sellers.businessProfile.phone'))
                                ->required(),

                            Forms\Components\TextInput::make('street')
                                ->label(trans('dashboard.sellers.businessProfile.street1'))
                                ->required(),


                            Forms\Components\TextInput::make('street2')
                                ->label(trans('dashboard.sellers.businessProfile.street2'))
                                ->required(),

                            Select::make('business_type_id')
                                ->label(trans('dashboard.sellers.businessProfile.business'))
                                ->options(function () {
                                    return BusinessType::pluck('name', 'id')->toArray();
                                })->required(),


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
                                ->required(),
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
                    ->url(fn (User $record) => 'sellers/show/' . $record->id),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),

            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                Tables\Actions\BulkAction::make('export')
                    ->action(fn (Collection $records) => (new SellerExport($records))->download('sellers.xlsx'))
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
            'index' => ListSellers::route('/'),
            'create' => CreateSeller::route('/create'),
            'edit' => EditSeller::route('/{record}/edit'),
            'show' => ShowSeller::route('/show/{id}'),

        ];
    }
}
