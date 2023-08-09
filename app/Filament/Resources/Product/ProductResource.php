<?php

namespace App\Filament\Resources\Product;

use App\Exports\ProductExport;
use App\Filament\Resources\Customer\CustomerResource\Pages\ShowProduct;
use App\Filament\Resources\Product\ProductResource\Pages;
use App\Filament\Resources\Product\ProductResource\RelationManagers;
use App\Models\Product\Attribute;
use Archilex\StackedImageColumn\Columns\StackedImageColumn;
use App\Models\Product\AttributeValue;
use App\Models\Product\Product;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;

use Filament\Forms;

use Filament\Forms\Components\Card;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TextInput;
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

    protected static function getNavigationLabel(): string
    {
        return trans('dashboard.products.products');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Card::make()->schema([


                    Tabs::make('Heading')
                        ->tabs([
                            Tabs\Tab::make('Genral')
                                ->label(trans('dashboard.products.genral'))

                                ->schema([
                                    Forms\Components\TextInput::make('name')
                                        ->label(trans('dashboard.name'))
                                        ->unique(ignoreRecord: true)
                                        ->required(),


                                    RichEditor::make('description')
                                        ->label(trans('dashboard.description'))
                                        ->required(),

                                    Toggle::make('is_dangerous_shipping')
                                        ->label(trans('dashboard.products.is dangerous shipping')),

                                    Select::make('category_id')
                                        ->relationship('category', 'name')
                                        ->label(trans('dashboard.products.category'))

                                        ->required()
                                        ->preload(),


                                    Select::make('user_id')
                                        ->relationship('user', 'name')
                                        ->label(trans('dashboard.products.user'))

                                        ->required()
                                        ->preload(),


                                    Select::make('status')
                                        ->options([
                                            0 => trans('dashboard.products.pending'),
                                            1 => trans('dashboard.products.approved'),
                                            2 => trans('dashboard.products.rejected'),
                                        ])
                                        ->label(trans('dashboard.products.status'))
                                        ->required(),

                                    Toggle::make('is_handcrafted')
                                        ->label(trans('dashboard.products.is handcrafted')),
                                    Forms\Components\TextInput::make('quantity')
                                        ->label(trans('dashboard.products.quantity'))
                                        ->required()
                                        ->numeric(),

                                    Forms\Components\TextInput::make('weight')
                                        ->label(trans('dashboard.products.weight'))

                                        ->numeric()
                                        ->required(),
                                    Toggle::make('is_batteries_shipping'),


                                    Forms\Components\TextInput::make('cash')
                                        ->label(trans('dashboard.products.cash'))
                                        ->numeric(),

                                    Forms\Components\TextInput::make('unit')
                                        ->label(trans('dashboard.products.unit'))
                                        ->required(),

                                    Toggle::make('is_liquid_shipping')
                                        ->label(trans('dashboard.products.is liquid shipping')),

                                    Forms\Components\TextInput::make('item_type')
                                        ->label(trans('dashboard.products.item type'))
                                        ->required(),


                                    // ...
                                ]),

                            Tabs\Tab::make('price')
                                ->label(trans('dashboard.products.price'))
                                ->schema([
                                    Forms\Components\TextInput::make('price')
                                        ->label(trans('dashboard.products.price'))
                                        ->numeric()
                                        ->required(),


                                    Forms\Components\TextInput::make('old_price')
                                        ->label(trans('dashboard.products.old price'))
                                        ->numeric()

                                        ->required(),

                                    // ...
                                ]),

                            Tabs\Tab::make('attributes')
                                ->label(trans('dashboard.products.attributes'))
                                ->schema([
                                    Repeater::make('attributes')
                                        ->relationship('productAttributes')
                                        ->label(trans('dashboard.products.attributes'))
                                        ->schema([
                                            Select::make('attribute_id')
                                                ->label(trans('dashboard.products.attributes'))
                                                ->options(function () {
                                                    return Attribute::pluck('name', 'id')->toArray();
                                                })->required()
                                                ->reactive()
                                                ->afterStateUpdated(fn (callable $set) => $set('attribute_value_id', null)),
                                            Select::make('attribute_value_id')
                                                ->label(trans('dashboard.products.attributes values'))

                                                ->options(function (callable $get) {
                                                    $attribite = Attribute::find($get('attribute_id'));
                                                    if (!$attribite) {
                                                        return AttributeValue::pluck('value', 'id')->toArray();
                                                    } else {
                                                        return $attribite->attributeValues->pluck('value', 'id')->toArray();
                                                    }
                                                })->required(),

                                        ])->columns(2),
                                ]),

                            Tabs\Tab::make('Medias')
                                ->label(trans('dashboard.products.medias'))

                                ->schema([


                                    SpatieMediaLibraryFileUpload::make('images')
                                        ->label(trans('dashboard.products.max size'))
                                        ->collection('images')
                                        ->image()
                                        ->minSize(1)
                                        ->maxSize(5120)
                                        ->multiple()

                                    // ...


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

                Tables\Columns\TextColumn::make('name')
                    ->label(trans('dashboard.name'))
                    ->sortable()->searchable(),

                Tables\Columns\TextColumn::make('price')
                    ->label(trans('dashboard.products.price'))
                    ->sortable()->searchable(),

                Tables\Columns\TextColumn::make('created_by')
                    ->label(trans('dashboard.products.created by'))
                    ->sortable()->searchable(),

                Tables\Columns\TextColumn::make('updated_by')
                    ->label(trans('dashboard.products.updated by'))
                    ->sortable()->searchable(),

                Tables\Columns\TextColumn::make('weight')
                    ->label(trans('dashboard.products.weight'))

                    ->sortable()->searchable(),
                Tables\Columns\TextColumn::make('quantity')
                    ->label(trans('dashboard.products.quantity'))

                    ->sortable()->searchable(),
                Tables\Columns\TextColumn::make('old_price')
                    ->label(trans('dashboard.products.old price'))

                    ->sortable()->searchable(),
                BooleanColumn::make('is_batteries_shipping')
                    ->label(trans('dashboard.products.is batteries shipping'))

                    ->sortable(),
                BooleanColumn::make('is_batteries_shipping')
                    ->label(trans('dashboard.products.is batteries shipping'))

                    ->sortable()->searchable(),
                BooleanColumn::make('is_dangerous_shipping')
                    ->label(trans('dashboard.products.is dangerous shipping'))

                    ->sortable()->searchable(),
                BooleanColumn::make('is_handcrafted')
                    ->label(trans('dashboard.products.is handcrafted'))


                    ->sortable()->searchable(),
                BooleanColumn::make('is_liquid_shipping')
                    ->label(trans('dashboard.products.is liquid shipping'))
                    ->sortable()->searchable(),


            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\Action::make('rates')
                ->url(fn (Product $record) => 'products/rates/' . $record->id),

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
            // 'show' => ShowProduct::route('/show/{id}'),

        ];
    }
}
