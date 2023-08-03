<?php

namespace App\Filament\Resources\Core;

use App\Filament\Resources\Core\SettingResource\Pages;
use App\Filament\Resources\Core\SettingResource\RelationManagers;
use App\Models\Core\Setting;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SettingResource extends Resource
{
    use Translatable;
    protected static ?string $model = Setting::class;
    protected static ?string $navigationGroup = 'core';


    protected static function getNavigationLabel(): string
    {
        return trans('dashboard.settings.settings');
    }


    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        //
                        TextInput::make('email')
                            ->label(trans('dashboard.settings.email')),
                        //phone
                        TextInput::make('phone')
                            ->label(trans('dashboard.settings.phone')),
                        //
                        TextInput::make('fb_link')
                            ->label(trans('dashboard.settings.fb_link')),

                        TextInput::make('skype_link')
                            ->label(trans('dashboard.settings.skype_link')),

                        TextInput::make('tw_link')
                            ->label(trans('dashboard.settings.tw_link')),

                        TextInput::make('linkedin_link')
                            ->label(trans('dashboard.settings.linkedin_link')),

                        TextInput::make('whatsapp')
                            ->label(trans('dashboard.settings.whatsapp')),

                        TextInput::make('inst_link')
                            ->label(trans('dashboard.settings.inst_link')),

                        RichEditor::make('about_us')
                            ->label(trans('dashboard.settings.about_us')),

                        RichEditor::make('terms_condition')
                            ->label(trans('dashboard.settings.terms_condition')),

                    ])

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('email')
                    ->label(trans('dashboard.settings.email')),
                //phone
                TextColumn::make('phone')
                    ->label(trans('dashboard.settings.phone')),
                //
                TextColumn::make('fb_link')
                    ->label(trans('dashboard.settings.fb_link')),

                TextColumn::make('skype_link')
                    ->label(trans('dashboard.settings.skype_link')),

                TextColumn::make('tw_link')
                    ->label(trans('dashboard.settings.tw_link')),

                TextColumn::make('linkedin_link')
                    ->label(trans('dashboard.settings.linkedin_link')),

                TextColumn::make('whatsapp')
                    ->label(trans('dashboard.settings.whatsapp')),

                TextColumn::make('inst_link')
                    ->label(trans('dashboard.settings.inst_link')),



            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([]);
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
            'index' => Pages\ListSettings::route('/'),
            'edit' => Pages\EditSetting::route('/{record}/edit'),
        ];
    }
}
