<?php

namespace App\Filament\Resources\ReceiveResource\Pages;

use App\Filament\Resources\ReceiveResource;
use App\Models\Receive;
use Carbon\Carbon;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateReceive extends CreateRecord
{
    protected static string $resource = ReceiveResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $recCount = Receive::whereYear('received_on', Carbon::now()->format('Y'))->whereMonth('received_on', Carbon::now()->format('m'))->count();
        $recNo = "RC" . Carbon::now()->format('Ym') . sprintf('%04d', $recCount + 1);
        $data['no'] = $recNo;
        $data['receive_by_id'] = Auth::user()->id;
        return $data;
    }
}
