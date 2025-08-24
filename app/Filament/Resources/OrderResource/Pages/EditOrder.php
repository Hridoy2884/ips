<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderUpdated;

class EditOrder extends EditRecord
{
    protected static string $resource = OrderResource::class;

    protected function afterSave(): void
    {
        $record = $this->record; // the edited order
        $changes = [];

        foreach (['payment_status', 'payment_method', 'status'] as $field) {
            if ($record->wasChanged($field)) {
                $changes[$field] = $record->$field;
            }
        }

        if (!empty($changes)) {
            Mail::to($record->user->email)->send(new OrderUpdated($record, $changes));
        }
    }
}
