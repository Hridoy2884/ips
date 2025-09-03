<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Group;

use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;
use Filament\Forms\Components\TextInput\Mask;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Forms\Components\RichEditor;
class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-square-3-stack-3d';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()->schema([
                    Section::make('Product Infromation')->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn(string $operation, $state, $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null),

                        TextInput::make('slug')

                            ->maxLength(255)
                            ->disabled()
                            ->unique(Product::class, 'slug', ignoreRecord: true)
                            ->label('Slug')
                            ->dehydrated(),

                      RichEditor::make('description')
    ->required()
    ->columnSpanFull()
    ->toolbarButtons([
        'bold',
        'italic',
        'strike',
        'bulletList',
        'orderedList',
        'link',
        'image',
        'blockquote',
        'code',
        'redo',
        'undo',
        'emoji', // emoji support
    ])
    ->fileAttachmentsDirectory('products') // store uploaded images
    ->placeholder('Write a detailed product description here with emojis, images, and rich formatting...'),




                    ])->columns(2),

                    Section::make('Images')->schema([
                        FileUpload::make('images')
                            ->multiple()
                            ->image()
                            ->directory('products')
                            ->maxFiles(5)
                            ->reorderable()
                            ->preserveFilenames()

                            ->columnSpanFull(),
                    ])


                ])->columnSpan(2),

                Group::make()->schema([
                    Section::make('Price')->schema([
                        TextInput::make('price')
                            ->numeric()
                            ->required()
                            ->label('Price')

                            ->prefix('BDT')
                            ->columnSpanFull(),
                    ]),
                    Section::make('Associations')->schema([
                        Select::make('category_id')
                            ->relationship('category', 'name')
                            ->required()
                            ->preload()
                            ->searchable(),
                        Select::make('brand_id')
                            ->relationship('brand', 'name')
                            ->required()
                            ->preload()
                            ->searchable(),






                    ]),

                    Section::make('Status')->schema([
                        Forms\Components\Toggle::make('is_active')
                            ->label('Is Active')
                            ->default(true)
                            ->inline(false)
                            ->required(),

                        Forms\Components\Toggle::make('is_featured')
                            ->label('Is Featured')
                            ->default(false)
                            ->inline(false)
                            ->required(),

                        Forms\Components\Toggle::make('in_stock')
                            ->label('In Stock')
                            ->default(true)
                            ->inline(false)
                            ->required(),

                        Forms\Components\Toggle::make('on_sale')
                            ->label('On Sale')
                            ->default(false)
                            ->inline(false)
                            ->required(),

                    ])->columns(2),




                ])->columnSpan(1)


            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('category.name')
                    ->searchable()
                    ->sortable(),

                    Tables\Columns\TextColumn::make('brand.name')
                    ->searchable()
                    ->sortable(),

                    Tables\Columns\TextColumn::make('price')
                    ->money('BDT')
             
                    ->sortable(),

                    IconColumn::make('is_active')
                    ->boolean(),

                    IconColumn::make('is_featured')
                    ->boolean(),
                    IconColumn::make('in_stock')
                    ->boolean(),
                    IconColumn::make('on_sale')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                    Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),




        
            ])
            ->filters([
                //
                SelectFilter::make('category')
                    ->relationship('category', 'name'),

                SelectFilter::make('brand')
                    ->relationship('brand', 'name'),
                 

            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make()
                        ->label('Edit')
                        ->icon('heroicon-o-pencil'),
                    Tables\Actions\DeleteAction::make()
                        ->label('Delete')
                        ->icon('heroicon-o-trash')
                        ->color('danger'),

                    Tables\Actions\ViewAction::make('View')
                        ->label('View')
                        ->icon('heroicon-o-eye')
                       
                        ->color('success'),
                       
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
