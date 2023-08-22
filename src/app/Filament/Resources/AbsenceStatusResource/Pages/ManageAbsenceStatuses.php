<?php

namespace App\Filament\Resources\AbsenceStatusResource\Pages;

use App\Filament\Resources\AbsenceStatusResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageAbsenceStatuses extends ManageRecords
{
    protected static string $resource = AbsenceStatusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
