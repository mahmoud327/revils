<?php

namespace App\Filament\Resources\Core;

use App\Filament\Resources\Core\BannerResource\Pages;
use App\Filament\Resources\Core\BannerResource\RelationManagers;
use App\Models\Core\Banner;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BannerResource extends Resource
{
    use Translatable;
    protected static ?string $model = Banner::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function getTranslatableLocales(): array
    {
        return ['en', 'ar'];
    }


    protected static function getNavigationLabel(): string
    {
        return trans('dashboard.banners.banners');
    }



    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Card::make()->schema([

                    Toggle::make('active')
                        ->label(trans('dashboard.active')),

                    SpatieMediaLibraryFileUpload::make('image')
                        ->label(trans('dashboard.products.max size'))
                        ->collection('banners'),

                    Forms\Components\TextInput::make('title')
                        ->label(trans('dashboard.banners.title'))

                        ->required()
                        ->unique(ignoreRecord: true),


                    RichEditor::make('description')
                        ->label(trans('dashboard.banners.description'))

                        ->required(),
                ])




            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make('title')->sortable()
                    ->label(trans('dashboard.banners.title'))
                    ->searchable(),
                Tables\Columns\ToggleColumn::make('active')->sortable()
                    ->label(trans('dashboard.active'))
                    ->searchable(),

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
            'index' => Pages\ListBanners::route('/'),
            'create' => Pages\CreateBanner::route('/create'),
            'edit' => Pages\EditBanner::route('/{record}/edit'),
        ];
    }
}
