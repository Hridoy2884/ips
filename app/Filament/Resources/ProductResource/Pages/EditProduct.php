<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProduct extends EditRecord
{
    protected static string $resource = ProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    // ✅ Fix to ensure images are passed as-is
    protected function mutateFormDataBeforeFill(array $data): array
    {
        // Only decode if it's a string, otherwise return as-is
        if (is_string($data['images'])) {
            $data['images'] = json_decode($data['images'], true) ?? [];
        }

        return $data;
    }
}
