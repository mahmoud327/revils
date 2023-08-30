<?php

namespace App\Filament\Resources\Core;

use App\Filament\Resources\Core\CouponResource\Pages;
use App\Filament\Resources\Core\CouponResource\RelationManagers;
use App\Models\Core\Coupon;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CouponResource extends Resource
{
    use Translatable;

    protected static ?string $model = Coupon::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static ?string $navigationGroup = 'core';


    public static function getTranslatableLocales(): array
    {
        return ['en', 'ar'];
    }
    protected static function getNavigationLabel(): string
    {
        return trans('dashboard.coupons.coupons');
    }



    public static function form(Form $form): Form
    {

        return $form
            ->schema([
                Card::make()->schema([
                    //


                    Forms\Components\TextInput::make('code')
                        ->label(trans('dashboard.code'))
                        ->required()
                        ->unique(ignoreRecord: true),

                    Select::make('type')
                        ->options([
                            'percentage' => trans('dashboard.coupons.percentage'),
                            'amount' => trans('dashboard.coupons.amount'),
                        ])
                        ->label(trans('dashboard.coupons.type'))
                        ->required(),

                    Forms\Components\TextInput::make('value')
                        ->label(trans('dashboard.coupons.value'))
                        ->numeric()
                        ->required(),

                    DatePicker::make('expiry_date')
                        ->label(trans('dashboard.coupons.expiry date'))
                        ->required()
                ])

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make('code')
                    ->label(trans('dashboard.code'))
                    ->sortable()->searchable(),

                Tables\Columns\TextColumn::make('type')
                    ->label(trans('dashboard.coupons.type'))
                    ->sortable()->searchable(),

                Tables\Columns\TextColumn::make('value')
                    ->label(trans('dashboard.coupons.value'))

                    ->sortable()->searchable(),
                Tables\Columns\TextColumn::make('expiry_date')
                    ->label(trans('dashboard.coupons.expiry date'))

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
            'index' => Pages\ListCoupons::route('/'),
            'create' => Pages\CreateCoupon::route('/create'),
            'edit' => Pages\EditCoupon::route('/{record}/edit'),
        ];
    }
}
