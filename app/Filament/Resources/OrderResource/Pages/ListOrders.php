<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\OrderResource\Widgets\OrderState;
use Filament\Resources\Pages\ListRecords\Tab; // ✅ Correct Tab import


class ListOrders extends ListRecords
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            OrderState::class,
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('All'),
            'new' => Tab::make('New')
                ->query(fn($query) => $query->where('status', 'new')),
            'proceessing' => Tab::make('Processing')
                ->query(fn($query) => $query->where('status', 'processing')),
            'shipped' => Tab::make('Shipped')
                ->query(fn($query) => $query->where('status', 'shipped')),
                
            'delivered' => Tab::make('Delivered')
                ->query(fn($query) => $query->where('status', 'delivered')),
            'cancelled' => Tab::make('Cancelled')
                ->query(fn($query) => $query->where('status', 'cancelled')),


        ];
    }
}
