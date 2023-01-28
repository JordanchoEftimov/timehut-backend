<?php

namespace App\Filament\Widgets;

use App\Models\Company;
use Filament\Tables;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class LatestCompanies extends BaseWidget
{
    protected static ?string $heading = 'Последни регистрирани компании';

    protected function getTableQuery(): Builder
    {
        return Company::query()->latest();
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('name')
                ->label('Име на компанија'),
            Tables\Columns\TextColumn::make('user.name')
                ->label('Сопственик'),
        ];
    }
}
