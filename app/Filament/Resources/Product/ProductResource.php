<?php

namespace App\Filament\Resources\Product;

use App\Exports\ProductExport;
use App\Filament\Resources\Product\ProductResource\Pages;
use App\Filament\Resources\Product\ProductResource\RelationManagers;
use App\Models\Product\AttributeValue;
use App\Models\Product\Product;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Columns\IconColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductResource extends Resource
{
    use Translatable;

    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static ?string $navigationGroup = 'products';

    public static function getTranslatableLocales(): array
    {
        return ['en', 'ar'];
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Card::make()->schema([


                    Tabs::make('Heading')
                        ->tabs([
                            Tabs\Tab::make('Genral')
                                ->schema([
                                    Forms\Components\TextInput::make('name')
                                        ->label('Name')
                                        ->unique(ignoreRecord: true)
                                        ->required(),


                                    RichEditor::make('description')
                                        ->label('description')
                                        ->required(),
                                        Toggle::make('is_dangerous_shipping'),


                                    Select::make('category_id')
                                        ->relationship('category', 'name')
                                        ->required()
                                        ->preload(),


                                    Select::make('status')
                                        ->options([
                                            0 => 'pennding',
                                            1 =>  'approve',
                                            2 => 'rejected',
                                        ])
                                        ->required(),

                                        Toggle::make('is_handcrafted'),

                                    Forms\Components\TextInput::make('quantity')
                                        ->label('quantity')
                                        ->required()
                                        ->numeric(),

                                    Forms\Components\TextInput::make('weight')
                                        ->label('weight')
                                        ->numeric()
                                        ->required(),
                                        Toggle::make('is_batteries_shipping'),


                                    Forms\Components\TextInput::make('cash')
                                        ->label('cash')
                                        ->numeric(),

                                    Forms\Components\TextInput::make('unit')
                                        ->label('unit')
                                        ->required(),

                                        Toggle::make('is_liquid_shipping'),

                                    Forms\Components\TextInput::make('item_type')
                                        ->label('item_type')
                                        ->required(),


                                    // ...
                                ]),

                            Tabs\Tab::make('price')
                                ->schema([
                                    Forms\Components\TextInput::make('price')
                                        ->label('price')
                                        ->numeric()
                                        ->required(),


                                    Forms\Components\TextInput::make('old_price')
                                        ->label('old price')
                                        ->numeric()

                                        ->required(),

                                    // ...
                                ]),

                            Tabs\Tab::make('Medias')
                                ->schema([
                                    // ...
                                    Repeater::make('media')
                                        ->schema([
                                            Forms\Components\FileUpload::make('media')
                                                ->multiple()
                                                ->enableDownload()
                                                ->enableReordering()
                                                ->enableOpen()
                                                ->directory('uploads-products')
                                                ->label('media')
                                                ->required()
                                            // ...
                                        ])

                                ]),

                        ])





                ])
                //

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make('name')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('price')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('weight')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('quantity')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('old_price')->sortable()->searchable(),
                BooleanColumn::make('is_batteries_shipping')->sortable(),
                BooleanColumn::make('is_batteries_shipping')->sortable()->searchable(),
                BooleanColumn::make('is_dangerous_shipping')->sortable()->searchable(),
                BooleanColumn::make('is_handcrafted')->sortable()->searchable(),
                BooleanColumn::make('is_liquid_shipping')->sortable()->searchable(),


            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                Tables\Actions\BulkAction::make('export')
                    ->action(fn (Collection $records) => (new ProductExport($records))->download('products.xlsx'))
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
