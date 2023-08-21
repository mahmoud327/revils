<?php

namespace App\Filament\Resources\Core;

use App\Filament\Resources\Core\PaymentResource\Pages;
use App\Filament\Resources\Core\PaymentResource\RelationManagers;
use App\Models\Core\Payment;
use Astrotomic\Translatable\Translatable;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Resources\Concerns\Translatable as ConcernsTranslatable;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PaymentResource extends Resource
{
    use ConcernsTranslatable;

    protected static ?string $model = Payment::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static ?string $navigationGroup = 'core';


    public static function getTranslatableLocales(): array
    {
        return ['en', 'ar'];
    }
    protected static function getNavigationLabel(): string
    {
        return trans('dashboard.payments.payments');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\TextInput::make('payment_type')
                    ->label(trans('dashboard.payments.payment_type'))
                    ->required()
                    ->unique(ignoreRecord: true),

                Forms\Components\TextInput::make('card_type')
                    ->label(trans('dashboard.payments.card_type'))
                    ->required(),

                Forms\Components\TextInput::make('card_digits')
                    ->label(trans('dashboard.payments.card_digits'))
                    ->numeric(),

                Forms\Components\TextInput::make('remarks')
                    ->label(trans('dashboard.payments.remarks')),

                Forms\Components\TextInput::make('paid_on')
                    ->label(trans('dashboard.payments.paid_on')),

                DatePicker::make('capture_date')
                    ->label(trans('dashboard.payments.capture_date'))
            ]);
    }



    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make('payment_type')
                    ->label(trans('dashboard.payments.payment_type'))
                    ->sortable()->searchable(),

                Tables\Columns\TextColumn::make('card_type')
                    ->label(trans('dashboard.payments.card_type'))
                    ->sortable()->searchable(),

                Tables\Columns\TextColumn::make('paid_on')
                    ->label(trans('dashboard.payments.paid_on'))
                    ->sortable()->searchable(),

                Tables\Columns\TextColumn::make('remarks')
                    ->label(trans('dashboard.payments.remarks'))
                    ->sortable()->searchable(),


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
            'index' => Pages\ListPayments::route('/'),
            'create' => Pages\CreatePayment::route('/create'),
            'edit' => Pages\EditPayment::route('/{record}/edit'),
        ];
    }
}
