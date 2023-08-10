<?php

namespace App\Filament\Resources\Core;

use App\Filament\Resources\CategoryResource\Pages;
use App\Filament\Resources\CategoryResource\RelationManagers;
use App\Filament\Resources\Core\CategoryResource\Pages\CreateCategory;
use App\Filament\Resources\Core\CategoryResource\Pages\EditCategory;
use App\Filament\Resources\Core\CategoryResource\Pages\ListCategories;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\Concerns\Translatable;
use Filament\Forms\Components\ColorPicker;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Card;
use Filament\Resources\Resource;
use App\Models\Core\Category;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Forms;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Tables;

class CategoryResource extends Resource
{
    use Translatable;
    protected static ?string $model = Category::class;

    protected static ?string $navigationIcon = 'heroicon-o-view-list';
    protected static ?string $navigationGroup = 'products';




    public static function getTranslatableLocales(): array
    {
        return ['en', 'ar'];
    }


    protected static function getNavigationLabel(): string
    {
        return trans('dashboard.categories.categories');
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    SpatieMediaLibraryFileUpload::make('image')
                        ->label(trans('dashboard.products.max size'))
                        ->collection('categories'),


                    Forms\Components\TextInput::make('name')
                        ->label(trans('dashboard.name'))
                        ->required(),



                    RichEditor::make('description')
                        ->label(trans('dashboard.description'))
                        ->required(),
                    ColorPicker::make('color')
                        ->label(trans('dashboard.categories.color'))
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
                Tables\Columns\TextColumn::make('name')
                    ->label(trans('dashboard.name'))

                    ->sortable()->searchable(),
                Tables\Columns\TextColumn::make('color')
                    ->label(trans('dashboard.categories.color'))

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
            'index' => ListCategories::route('/'),
            'create' => CreateCategory::route('/create'),
            'edit' => EditCategory::route('/{record}/edit'),
        ];
    }
}
