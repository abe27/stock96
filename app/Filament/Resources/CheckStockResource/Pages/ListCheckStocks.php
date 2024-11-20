<?php

namespace App\Filament\Resources\CheckStockResource\Pages;

use App\Filament\Resources\CheckStockResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCheckStocks extends ListRecords
{
    protected static string $resource = CheckStockResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('เพิ่มข้อมูล')
                ->icon('heroicon-o-plus-circle')
                ->button(),
        ];
    }
}
