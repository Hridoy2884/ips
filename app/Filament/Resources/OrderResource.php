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
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
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
                                'stripe' => 'Stripe',
                                'bkash' => 'Bkash',
                                'nagad' => 'Nagad',
                                'rocket' => 'Rocket',
                                'cod' => 'Cash On Delivery',
                                'manual' => 'Manual Payment',
                            ])
                            ->required(),

                        Select::make('payment_status')
                            ->options([
                                'pending' => 'Pending',
                                'adcanced' => 'Advanced',
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
                            ->label('Order Status')
                            ->colors([
                                'new' => 'info',
                                'processing' => 'warning',
                                'shipped' => 'success',
                                'delivered' => 'success',
                                'canceled' => 'danger',
                            ])
                            ->icons([
                                'new' => 'heroicon-m-sparkles',
                                'processing' => 'heroicon-m-arrow-path',
                                'shipped' => 'heroicon-m-truck',
                                'delivered' => 'heroicon-m-check-circle',
                                'canceled' => 'heroicon-m-x-circle',
                            ]),

                        Select::make('currency')
                            ->options([
                                'bdt' => 'BDT',
                                'usd' => 'USD',
                            ])
                            ->default('bdt')
                            ->required(),

                        Select::make('shipping_method')
                            ->options([
                                'paperfly' => 'Paperfly',
                                'steadfast' => 'SteadFast',
                                'redx' => 'REDX',
                            ])
                            ->required(),

                        Textarea::make('notes')
                            ->columnSpanFull(),

                        // Manual Payment Fields
                        Forms\Components\TextInput::make('transaction_id')
                            ->label('Transaction ID')
                            ->visible(fn(callable $get) => $get('payment_method') === 'manual')
                            ->required(fn(callable $get) => $get('payment_method') === 'manual'),

                        Forms\Components\FileUpload::make('payment_proof')
                            ->label('Payment Proof')
                            ->image()
                            ->visible(fn(callable $get) => $get('payment_method') === 'manual')
                            ->nullable(),

                        // Advance Amount placeholder and hidden input
                        Placeholder::make('advance_amount_placeholder')
                            ->label('Advance Amount (15%)')
                            ->content(fn(callable $get) => 'BDT ' . number_format($get('advance_amount') ?? 0, 2))
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
                                    ->afterStateUpdated(
                                        function (callable $set, $state, callable $get) {
                                            $product = \App\Models\Product::find($state);
                                            if ($product) {
                                                $set('unit_amount', $product->price);
                                                $set('total_amount', $product->price * ($get('quantity') ?? 1));
                                            }
                                        }
                                    ),

                                Forms\Components\TextInput::make('quantity')
                                    ->numeric()
                                    ->required()
                                    ->minValue(1)
                                    ->default(1)
                                    ->label('Quantity')
                                    ->columnSpan(2)
                                    ->reactive()
                                    ->afterStateUpdated(
                                        function (callable $set, $state, callable $get) {
                                            $unit_amount = $get('unit_amount');
                                            $set('total_amount', $unit_amount * ($state ?? 1));
                                        }
                                    ),
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
                            ->content(function (Get $get, Set $set) {
                                $total = 0;

                                if (!$repeaters = $get('orderItems')) {
                                    return 'BDT ' . number_format($total, 2);
                                }

                                foreach ($repeaters as $key => $repeater) {
                                    $total += (float) $get("orderItems.{$key}.total_amount");
                                }

                                // Set the grand_total field with the computed total
                                $set('grand_total', $total);

                                // Calculate advance_amount as 15% of grand_total if payment method is cod
                                if ($get('payment_method') === 'cod') {
                                    $set('advance_amount', round($total * 0.15, 2));
                                } else {
                                    $set('advance_amount', 0);
                                }

                                return 'BDT ' . number_format($total, 2);
                            }),

                        Hidden::make('grand_total')->default(0),
                    ])->columns(1),

                ])->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->sortable()
                    ->searchable()
                    ->label('Customer'),


                TextColumn::make('grand_total')
                    ->sortable()
                    ->numeric()
                    ->money('BDT'),

                TextColumn::make('advance_amount')
                    ->label('Advance Amount')
                    ->money('BDT')
                    ->sortable()
                    ->searchable(),

                    
                TextColumn::make('transaction_id')
                    ->label('Transaction ID')
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: false), // Always visible


                TextColumn::make('payment_method')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('payment_status')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('currency')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('shipping_method')
                    ->sortable()
                    ->searchable(),

                SelectColumn::make('status')
                    ->options([
                        'new' => 'New',
                        'processing' => 'Processing',
                        'shipped' => 'Shipped',
                        'delivered' => 'Delivered',
                        'canceled' => 'Canceled',
                    ])
                    ->sortable()
                    ->searchable(),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
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
