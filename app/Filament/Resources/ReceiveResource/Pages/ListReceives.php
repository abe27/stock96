<?php

namespace App\Filament\Resources\ReceiveResource\Pages;

use App\Filament\Resources\ReceiveResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListReceives extends ListRecords
{
    protected static string $resource = ReceiveResource::class;

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
