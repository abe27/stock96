<?php

namespace App\Filament\Resources\StoreNameResource\Pages;

use App\Filament\Resources\StoreNameResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListStoreNames extends ListRecords
{
    protected static string $resource = StoreNameResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
