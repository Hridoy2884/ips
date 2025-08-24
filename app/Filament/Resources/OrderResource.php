<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\SelectColumn;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()->schema([
                    Section::make('Order Information')->schema([
                        Select::make('user_id')
                            ->relationship('user', 'name')
                            ->label('Customer')
                            ->required()
                            ->preload(),

                        Select::make('payment_method')
                            ->options([
                                'cod' => 'Cash On Delivery',
                                'bkash' => 'bKash',
                                'nagad' => 'Nagad',
                                'rocket' => 'Rocket',
                                'bank' => 'Bank Transfer',
                                'manual' => 'Manual Payment',
                            ])
                            ->required()
                            ->reactive(),

                        Select::make('payment_status')
                            ->options([
                                'pending' => 'Pending',
                                'advanced' => 'Advanced',
                                'paid' => 'Paid',
                                'failed' => 'Failed',
                            ])
                            ->required()
                            ->default('pending'),

                        ToggleButtons::make('status')
                            ->options([
                                'new' => 'New',
                                'processing' => 'Processing',
                                'shipped' => 'Shipped',
                                'delivered' => 'Delivered',
                                'canceled' => 'Canceled',
                            ])
                            ->required()
                            ->default('new')
                            ->inline()
                            ->label('Order Status'),

                        Select::make('currency')
                            ->options([
                                'bdt' => 'BDT',
                                'usd' => 'USD',
                            ])
                            ->default('bdt')
                            ->required(),

                        Select::make('shipping_method')
                            ->options([
                                'A.J.R Parcel' => 'A.J.R Parcel & Courier Service Ltd',
                                'S.A Paribahan' => 'S.A Paribahan',
                                'steadfast' => 'Steadfast',
                                'paperfly' => 'Paperfly',
                                'redx' => 'RedX',
                                'pathao' => 'Pathao',
                                'Shodagor Express' => 'Shodagor Express',
                                'Ahmed Parcel' => 'Ahmed Parcel',
                                'Sundarban Courier' => 'Sundarban Courier Service',
                            ])
                            ->required(),

                        Textarea::make('notes')->columnSpanFull(),

                        Forms\Components\TextInput::make('transaction_id')
                            ->label('Transaction ID')
                            ->visible(fn(callable $get) => in_array($get('payment_method'), ['cod','manual','bank','bkash','nagad','rocket']))
                            ->required(fn(callable $get) => in_array($get('payment_method'), ['cod','manual','bank','bkash','nagad','rocket'])),

                        Forms\Components\FileUpload::make('payment_proof')
                            ->label('Payment Proof')
                            ->image()
                            ->nullable()
                            ->visible(fn(callable $get) => in_array($get('payment_method'), ['manual','bank','bkash','nagad','rocket'])),

                        Placeholder::make('advance_amount_placeholder')
                            ->label('Advance Amount (15% for COD)')
                            ->content(function(Get $get) {
                                $advance = 0;
                                if($get('payment_method') === 'cod' && $get('grand_total')){
                                    $advance = round($get('grand_total') * 0.15, 2);
                                }
                                return 'BDT ' . number_format($advance, 2);
                            })
                            ->columnSpanFull(),

                        Hidden::make('advance_amount')->default(0),
                    ])->columns(2),

                    Section::make('Items')->schema([
                        Repeater::make('orderItems')
                            ->relationship()
                            ->schema([
                                Select::make('product_id')
                                    ->relationship('product', 'name')
                                    ->required()
                                    ->preload()
                                    ->searchable()
                                    ->distinct()
                                    ->disableOptionsWhenSelectedInSiblingRepeaterItems()
                                    ->columnSpan(4)
                                    ->reactive()
                                    ->afterStateUpdated(function (callable $set, $state, callable $get) {
                                        $product = \App\Models\Product::find($state);
                                        if($product){
                                            $set('unit_amount', $product->price);
                                            $set('total_amount', $product->price * ($get('quantity') ?? 1));
                                        }
                                    }),

                                Forms\Components\TextInput::make('quantity')
                                    ->numeric()
                                    ->required()
                                    ->minValue(1)
                                    ->default(1)
                                    ->columnSpan(2)
                                    ->reactive()
                                    ->afterStateUpdated(function(callable $set, $state, callable $get){
                                        $unit_amount = $get('unit_amount');
                                        $set('total_amount', $unit_amount * ($state ?? 1));
                                    }),

                                Forms\Components\TextInput::make('unit_amount')
                                    ->numeric()
                                    ->required()
                                    ->disabled()
                                    ->dehydrated()
                                    ->columnSpan(3),

                                Forms\Components\TextInput::make('total_amount')
                                    ->numeric()
                                    ->required()
                                    ->disabled()
                                    ->dehydrated()
                                    ->columnSpan(3),
                            ])->columns(12),

                        Placeholder::make('grand_total_placeholder')
                            ->label('Grand Total Amount')
                            ->content(function(Get $get, Set $set){
                                $total = 0;
                                $repeaters = $get('orderItems') ?? [];
                                foreach($repeaters as $key => $repeater){
                                    $total += (float)$get("orderItems.{$key}.total_amount");
                                }

                                $set('grand_total', $total);

                                if($get('payment_method') === 'cod'){
                                    $set('advance_amount', round($total * 0.15, 2));
                                } else {
                                    $set('advance_amount', 0);
                                }

                                if($get('payment_method') === 'bkash'){
                                    $set('total_with_fee', round($total * 1.0185, 2));
                                } else {
                                    $set('total_with_fee', $total);
                                }

                                return 'BDT ' . number_format($total, 2);
                            }),

                        Hidden::make('grand_total')->default(0),
                        Hidden::make('total_with_fee')->default(0),
                    ])->columns(1),
                ])->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')->label('Customer')->sortable()->searchable(),
                TextColumn::make('grand_total')->sortable()->money('BDT'),
                TextColumn::make('advance_amount')->sortable()->money('BDT'),
                TextColumn::make('total_with_fee')->label('Total with Fee')->money('BDT')->sortable(),
                TextColumn::make('transaction_id')->label('Transaction ID')->sortable()->searchable(),
                TextColumn::make('payment_method')->sortable()->searchable(),
                TextColumn::make('payment_status')->sortable()->searchable(),
                TextColumn::make('currency')->sortable()->searchable(),
                TextColumn::make('shipping_method')->sortable()->searchable(),
                SelectColumn::make('status')->options([
                    'new' => 'New',
                    'processing' => 'Processing',
                    'shipped' => 'Shipped',
                    'delivered' => 'Delivered',
                    'canceled' => 'Canceled',
                ])->sortable()->searchable(),
                TextColumn::make('created_at')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make()->label('Edit')->icon('heroicon-o-pencil'),
                    Tables\Actions\DeleteAction::make()->label('Delete')->icon('heroicon-o-trash')->color('danger'),
                    Tables\Actions\ViewAction::make('View')->label('View')->icon('heroicon-o-eye')->color('success'),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\AddressRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'view' => Pages\ViewOrder::route('/{record}'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
