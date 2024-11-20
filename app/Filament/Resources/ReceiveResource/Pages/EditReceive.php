<?php

namespace App\Filament\Resources\ReceiveResource\Pages;

use App\Filament\Resources\ReceiveResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditReceive extends EditRecord
{
    protected static string $resource = ReceiveResource::class;

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
