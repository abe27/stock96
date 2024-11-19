<?php

namespace App\Filament\Resources\CheckStockResource\Pages;

use App\Filament\Resources\CheckStockResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCheckStock extends EditRecord
{
    protected static string $resource = CheckStockResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
