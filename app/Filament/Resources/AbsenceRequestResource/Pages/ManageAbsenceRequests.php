<?php

namespace App\Filament\Resources\AbsenceRequestResource\Pages;

use App\Filament\Resources\AbsenceRequestResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageAbsenceRequests extends ManageRecords
{
    protected static string $resource = AbsenceRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
