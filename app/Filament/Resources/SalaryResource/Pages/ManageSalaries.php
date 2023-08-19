<?php

namespace App\Filament\Resources\SalaryResource\Pages;

use App\Filament\Resources\SalaryResource;
use Filament\Resources\Pages\ManageRecords;

class ManageSalaries extends ManageRecords
{
    protected static string $resource = SalaryResource::class;

    protected function getHeaderActions(): array
    {
        return [

        ];
    }
}
