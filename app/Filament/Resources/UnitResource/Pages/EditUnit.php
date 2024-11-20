<?php

namespace App\Filament\Resources\UnitResource\Pages;

use App\Filament\Resources\UnitResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUnit extends EditRecord
{
    protected static string $resource = UnitResource::class;

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

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
