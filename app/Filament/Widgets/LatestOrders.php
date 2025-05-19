<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Filament\Tables\Columns\TextColumn;

class LatestOrders extends BaseWidget
{
    protected static ?int $sort = 1; // Adjust to control order of widgets

    protected int|string|array $columnSpan = 'full'; // Optional: adjust widget width

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Order::query()
                    ->latest()
                    ->limit(5)
            )
            ->columns([
                TextColumn::make('id')
                    ->label('Order ID')
                    ->sortable(),

                TextColumn::make('user.name') // Assumes Order belongs to User
                    ->label('Customer'),

                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state) => match ($state) {
                        'pending' => 'warning',
                        'shipped' => 'info',
                        'delivered' => 'success',
                        'cancelled' => 'danger',
                        default => 'gray',
                    }),

                TextColumn::make('created_at')
                    ->label('Date')
                    ->dateTime()
                    ->sortable(),
            ])
            
            ->actions([
                Tables\Actions\Action::make('view')
                    ->label('View')
                    ->url(fn (Order $record): string => route('filament.admin.resources.orders.edit', ['record' => $record]))
                    ->icon('heroicon-o-eye')
                    ->color('primary')
                   
            ]);
            
    }
}
