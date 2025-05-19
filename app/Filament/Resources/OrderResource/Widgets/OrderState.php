<?php

namespace App\Filament\Resources\OrderResource\Widgets;


use App\Models\Order;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Number;
use Carbon\Carbon;

class OrderState extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('New Orders', Order::query()->where('status', 'new')->count()),
            Stat::make('Order Processing', Order::query()->where('status', 'processing')->count()),

            Stat::make('Order Shipped', Order::query()->where('status', 'shipped')->count()),

            


           Stat::make('Total Price', Number::currency(Order::query()->sum('grand_total'), 'BDT')),

               Stat::make('Today\'s Sales', Number::currency(
            Order::query()
                ->whereDate('created_at', Carbon::today())
                ->sum('grand_total'), 
            'BDT'
        )),

           

            
            
        ];
    }
}
