<?php

namespace App\Filament\Widgets;

use App\Enums\UserType;
use App\Models\Employee;
use Filament\Tables;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class LatestEmployees extends BaseWidget
{
    protected static ?string $heading = 'Последни регистрирани вработени';

    public static function canView(): bool
    {
        return auth()->user()->type->value === UserType::COMPANY->value;
    }

    protected function getTableQuery(): Builder
    {
        return Employee::query()->latest();
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('name')
                ->label('Име'),
            Tables\Columns\TextColumn::make('surname')
                ->label('Презиме'),
        ];
    }
}
