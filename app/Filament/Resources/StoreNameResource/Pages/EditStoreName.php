<?php

namespace App\Filament\Resources\StoreNameResource\Pages;

use App\Filament\Resources\StoreNameResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditStoreName extends EditRecord
{
    protected static string $resource = StoreNameResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->label('ลบข้อมูล')
                ->icon('heroicon-o-x-circle')
                ->requiresConfirmation()
                ->button(),
        ];
    }
}
